<?php

namespace Rental\Services\Admin\Auth;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use MyCommon\Libraries\Utils\OpensslCryptUtils;

use Rental\Services\Admin\Auth\GenericAdminAccount;

class AdminAuthGuard implements StatefulGuard
{
    const COOKIE_ACCOUNT_INFOS_AES256 = 'RS19A01';
    const COOKIE_CHECKSUM = 'RS19A99';

    const CRYPT_BLOWFISH_KEY = 'Dddn3D5TW8Yz6ChMjV6YkevGVjmgTD6z';
    const CRYPT_PASSWORD = '4Cbpwt7Nq9MJEFm8Nn2BvELd';

    const REDIS_ADMIN_ID = 'admin_account_id';
    const REDIS_ADMIN_NAME = 'name';
    const REDIS_ADMIN_ADDRESS = 'address';
    const REDIS_LOGIN_KEY = 'login_key';

    // サーバ側変数保持期間は 7日（7 * 60sec * 60min * 24hour = 604800sec）
    const EXPIRE_DATA_ON_SERVER = 604800;

    protected $provider;
    protected $session;
    protected $admin;
    protected $isCacheReset = FALSE;

    public function __construct(UserProvider $provider)
    {
        $app = app();
        $this->session = $app['session.store'];
        $this->provider = $provider;
        $this->admin = null;
    }

    /**
     * Attempt to authenticate a company account using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool   $remember
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false)
    {
        $admin = $this->provider->retrieveByCredentials($credentials);
        if (!$this->provider->validateCredentials($admin, $credentials)) {
            return false;
        }
        $this->admin = $admin;
        $this->login($admin);
        return true;
    }

    /**
     * Log a user into the application without sessions or cookies.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function once(array $credentials = [])
    {
        return false;
    }

    /**
     * Log a user into the application.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $admin
     * @param  bool  $remember
     * @return void
     */
    public function login(Authenticatable $admin, $remember = false)
    {
        $this->logout();

        // ログインキー生成
        $loginKey = $this->_generateLoginKey();

        // チェックサム生成
        $checksum = $this->_encryptBlowfish($admin, $loginKey);

        // データをCookieに登録
        $this->_setCookie($admin, $loginKey, $checksum);

        // データをセッション(Redis)に設定
        $this->_setSession($admin, $loginKey, $checksum);
        return;
    }

    /**
     * ログイン情報リセット処理
     * @param $admin_account_id
     * @return bool
     */
    public function resetAccountByUserID($admin_account_id)
    {
        $admin = $this->provider->retrieveById($admin_account_id);
        if (!$admin) {
            return FALSE;
        }
        $this->login($admin, FALSE);
    }

    /**
     * isCacheReset
     *
     * ログイン情報がサーバキャッシュに登録し直されたかどうかを真偽値で返す
     *
     * @return bool
     */
    public function isCacheReset()
    {
        return $this->isCacheReset;
    }

    /**
     * Log the given user ID into the application.
     *
     * @param  mixed  $id
     * @param  bool   $remember
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function loginUsingId($id, $remember = false)
    {
        return null;
    }

    /**
     * Log the given user ID into the application without sessions or cookies.
     *
     * @param  mixed  $id
     * @return bool
     */
    public function onceUsingId($id)
    {
        return false;
    }

    /**
     * Determine if the user was authenticated via "remember me" cookie.
     *
     * @return bool
     */
    public function viaRemember()
    {
        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout()
    {
        $checksum = \Cookie::get(self::COOKIE_CHECKSUM);

        // Cookieを削除
        \Cookie::queue(\Cookie::forget(self::COOKIE_ACCOUNT_INFOS_AES256));
        \Cookie::queue(\Cookie::forget(self::COOKIE_CHECKSUM));

        // セッション情報を削除
        \Redis::del($checksum.self::REDIS_ADMIN_ID);
        \Redis::del($checksum.self::REDIS_ADMIN_NAME);
        \Redis::del($checksum.self::REDIS_ADMIN_ADDRESS);
        \Redis::del($checksum.self::REDIS_LOGIN_KEY);

        // インスタンス変数削除
        $this->admin = null;
        return;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        $accountInfoed = \Cookie::get(self::COOKIE_ACCOUNT_INFOS_AES256);
        $checkSumInCookie = \Cookie::get(self::COOKIE_CHECKSUM);
        //=======================================================
        // Cookie から情報を取得
        //=======================================================
        if (empty($checkSumInCookie) || empty($accountInfoed)) {
            return FALSE;
        }

        //=======================================================
        // ログイン判定
        //=======================================================
        if($this->_compareSessionWithCookie()) {
            return TRUE;
        }
        //=======================================================
        // Cookie内の情報のみで判定
        //=======================================================
        elseif ($this->_ensureCookie()) {
            // ログイン情報をサーバキャッシュに登録し直す
            $decrypted = $this->_getDecryptedAccountInfoFromCookie();
            if (empty($decrypted)) {
                return FALSE;
            }

            $user = $this->provider->retrieveById($decrypted['admin_account_id']);
            $check_sum = $this->_encryptBlowfish($user, $decrypted['loginKey']);
            $this->_setSession($user, $decrypted['loginKey'], $check_sum);

            $this->isCacheReset = TRUE;

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest()
    {
        return false;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (is_null($this->admin)) {
            $this->check();
        }
        return $this->admin;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        $admin_account_id = null;
        if (!$this->_hasCheckSum()) {
            return $admin_account_id;
        }
        $checkSum = \Cookie::get(self::COOKIE_CHECKSUM);
        $admin_account_id = $this->_getRedisKey($checkSum.self::REDIS_ADMIN_ID);
        return $admin_account_id;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        $user = $this->provider->retrieveByCredentials($credentials);
        return $this->provider->validateCredentials($user, $credentials);
    }

    /**
     * Set the current admin.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $admin
     * @return void
     */
    public function setUser(Authenticatable $admin)
    {
        $this->admin = $admin;
        $this->login($admin);
        return true;
    }

    /**
     * ログインキー生成
     */
    protected function _generateLoginKey()
    {
        // 1970/01/01 00:00:00から現在までの経過秒数を36進変換したものをログインキーにする
        $loginKey = base_convert(strtotime("now"), 10, 36);
        return $loginKey;
    }

    protected function _encryptBlowfish($admin, $loginKey)
    {
        $admin_account_id = $admin->getAccountId();
        $name = $admin->getName();
        $address = $admin->getAddress();
        return $this->_encryptBlowfishWithAccountInfo($admin_account_id, $name, $address, $loginKey);
    }

    protected function _encryptBlowfishWithAccountInfo( $admin_account_id,
                                                        $name,
                                                        $address,
                                                        $login_key )
    {
        $joined = $admin_account_id.$name.$address.$login_key;
        $reversed = strrev($joined);
        $encrypted = crypt($reversed, self::CRYPT_BLOWFISH_KEY);
        return $encrypted;
    }

    protected function _setCookie(GenericAdminAccount $admin, $loginKey, $checksum)
    {
        $admin_account_id = $admin->getAccountId();
        $name = $admin->getName();
        $address = $admin->getAddress();

        $joined = $admin_account_id.'|'.$name.'|'.$address.'|'.$loginKey;

        // PK | 名前 | ログインキーの 暗号化
        $cryptUtils = new OpensslCryptUtils();
        $encrypted = $cryptUtils->encrypt($joined, self::CRYPT_PASSWORD);
        $encryptedAccountInfo = $encrypted['encrypt'].'|'.$encrypted['iv'];

        // Cookieにセット
        \Cookie::queue(cookie()->forever(self::COOKIE_ACCOUNT_INFOS_AES256, $encryptedAccountInfo));
        \Cookie::queue(cookie()->forever(self::COOKIE_CHECKSUM, $checksum));
    }

    protected function _setSession(GenericAdminAccount $admin, $loginKey, $checksum)
    {
        $admin_account_id = $admin->getAccountId();
        $name = $admin->getName();
        $address = $admin->getAddress();

        // セッション(Redis)に格納
        \Redis::setex($checksum.self::REDIS_ADMIN_ID, self::EXPIRE_DATA_ON_SERVER, serialize($admin_account_id));
        \Redis::setex($checksum.self::REDIS_ADMIN_NAME, self::EXPIRE_DATA_ON_SERVER, serialize($name));
        \Redis::setex($checksum.self::REDIS_ADMIN_ADDRESS, self::EXPIRE_DATA_ON_SERVER, serialize($address));
        \Redis::setex($checksum.self::REDIS_LOGIN_KEY, self::EXPIRE_DATA_ON_SERVER, serialize($loginKey));

        return;
    }

    protected function _hasCheckSum()
    {
        $checkSum = \Cookie::get(self::COOKIE_CHECKSUM);
        return !empty($checkSum);
    }

    protected function _compareSessionWithCookie()
    {
        //=======================================================
        // Cookieとセッションの内容の突き合わせ
        //=======================================================
        $checkSumInCookie = \Cookie::get(self::COOKIE_CHECKSUM);

        $admin_account_id = $this->_getRedisKey($checkSumInCookie.self::REDIS_ADMIN_ID);
        $admin_name = $this->_getRedisKey($checkSumInCookie.self::REDIS_ADMIN_NAME);
        $admin_address = $this->_getRedisKey($checkSumInCookie.self::REDIS_ADMIN_ADDRESS);
        $login_key = $this->_getRedisKey($checkSumInCookie.self::REDIS_LOGIN_KEY);

        $checkSum = $this->_encryptBlowfishWithAccountInfo($admin_account_id, $admin_name, $admin_address, $login_key);

        // 突き合わせ
        if ($checkSumInCookie != $checkSum) {
            return false;
        }

        if (empty($this->admin)) {
            $this->admin = $this->provider->retrieveById($admin_account_id);
        }

        return true;
    }

    protected function _ensureCookie()
    {
        $checkSumInCookie = \Cookie::get(self::COOKIE_CHECKSUM);
        $decrypted = $this->_getDecryptedAccountInfoFromCookie();
        if (empty($checkSumInCookie) || empty($decrypted)) {
            return false;
        }

        $admin_account_id = \Arr::get($decrypted, 'admin_account_id');
        $name = \Arr::get($decrypted, 'name');
        $address = \Arr::get($decrypted, 'address');
        $login_key = \Arr::get($decrypted, 'loginKey');

        $checkSum = $this->_encryptBlowfishWithAccountInfo($admin_account_id, $name, $address, $login_key);
        return ($checkSumInCookie == $checkSum);
    }

    public function getDecryptedAccountInfoFromCookie()
    {
        return $this->_getDecryptedAccountInfoFromCookie();
    }

    protected function _getDecryptedAccountInfoFromCookie()
    {
        // Cookieの値を取得
        $encryptedAccountInfo = \Cookie::get(self::COOKIE_ACCOUNT_INFOS_AES256);
        if (empty($encryptedAccountInfo)) {
            return NULL;
        }

        // 暗号化された文字列と、初期化ベクトルとに、分解
        $a = explode('|', $encryptedAccountInfo);
        $encrypt = \Arr::get($a, 0);
        $iv = \Arr::get($a, 1);

        // 復号
        $cryptUtils = new OpensslCryptUtils();
        $decrypted = $cryptUtils->decrypt($encrypt, self::CRYPT_PASSWORD, $iv);
        $accountInfo = explode('|', $decrypted);

        $keys = ['admin_account_id', 'name', 'address', 'loginKey'];
        if (count($keys) == count($accountInfo)) {
            return array_combine($keys, $accountInfo);
        }

        return NULL;
    }

    protected function _getRedisKey($key)
    {
        $value = \Redis::get($key);
        return (!empty($value) ? unserialize($value):$value);
    }

    protected function _getLatestCookie($key)
    {
        $queued = \Cookie::queued($key);
        if (!is_null($queued)) {
            $queuedCokkie = $queued->getValue();
            if(!empty($queuedCokkie)){
                return $queuedCokkie;
            }
        }
        return \Request::cookie($key);
    }
}
