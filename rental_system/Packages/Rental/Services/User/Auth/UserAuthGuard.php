<?php

namespace Rental\Services\User\Auth;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use MyCommon\Libraries\Utils\OpensslCryptUtils;

use Rental\Services\User\Auth\GenericUserAccount;

class UserAuthGuard implements StatefulGuard
{
    const COOKIE_ACCOUNT_INFOS_AES256 = 'RS19C01';
    const COOKIE_CHECKSUM = 'RS19C99';

    const CRYPT_BLOWFISH_KEY = '$2y$07$sd4QXBfN8NVWQWZqpYmthS';
    const CRYPT_PASSWORD = '4Cbpwt7Nq9MJEFm8Nn2BvELd';

    const REDIS_USER_ID = 'user_id';
    const REDIS_USER_NAME = 'name';
    const REDIS_USER_ADDRESS = 'address';
    const REDIS_USER_DIVISION_ID = 'division_id';
    const REDIS_USER_GROUP_ID = 'group_id';
    const REDIS_LOGIN_KEY = 'login_key';

    // サーバ側変数保持期間は 7日（7 * 60sec * 60min * 24hour = 604800sec）
    const EXPIRE_DATA_ON_SERVER = 604800;

    protected $provider;
    protected $session;
    protected $user;
    protected $isCacheReset = FALSE;

    public function __construct(UserProvider $provider)
    {
        $app = app();
        $this->session = $app['session.store'];
        $this->provider = $provider;
        $this->user = null;
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
        $user = $this->provider->retrieveByCredentials($credentials);
        if (!$this->provider->validateCredentials($user, $credentials)) {
            return false;
        }
        $this->user = $user;
        $this->login($user);
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
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  bool  $remember
     * @return void
     */
    public function login(Authenticatable $user, $remember = false)
    {
        $this->logout();

        // ログインキー生成
        $loginKey = $this->_generateLoginKey();

        // チェックサム生成
        $checksum = $this->_encryptBlowfish($user, $loginKey);

        // データをCookieに登録
        $this->_setCookie($user, $loginKey, $checksum);

        // データをセッション(Redis)に設定
        $this->_setSession($user, $loginKey, $checksum);
        return;
    }

    /**
     * ログイン情報リセット処理
     * @param $user_id
     * @return bool
     */
    public function resetAccountByUserID($user_id)
    {
        $user = $this->provider->retrieveById($user_id);
        if (!$user) {
            return FALSE;
        }
        $this->login($user, FALSE);
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
        \Redis::del($checksum.self::REDIS_USER_ID);
        \Redis::del($checksum.self::REDIS_USER_NAME);
        \Redis::del($checksum.self::REDIS_USER_ADDRESS);
        \Redis::del($checksum.self::REDIS_USER_DIVISION_ID);
        \Redis::del($checksum.self::REDIS_USER_GROUP_ID);
        \Redis::del($checksum.self::REDIS_LOGIN_KEY);

        // インスタンス変数削除
        $this->user = null;
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

            $user = $this->provider->retrieveById($decrypted['user_id']);
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
        if (is_null($this->user)) {
            $this->check();
        }
        return $this->user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        $user_id = null;
        if (!$this->_hasCheckSum()) {
            return $user_id;
        }
        $checkSum = \Cookie::get(self::COOKIE_CHECKSUM);
        $user_id = $this->_getRedisKey($checkSum.self::REDIS_USER_ID);
        return $user_id;
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
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        $this->login($user);
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

    protected function _encryptBlowfish($user, $loginKey)
    {
        $user_id = $user->getUserId();
        $name = $user->getName();
        $address = $user->getAddress();
        return $this->_encryptBlowfishWithAccountInfo($user_id, $name, $address, $loginKey);
    }

    protected function _encryptBlowfishWithAccountInfo( $user_id,
                                                        $name,
                                                        $address,
                                                        $login_key )
    {
        $joined = $user_id.$name.$address.$login_key;
        $reversed = strrev($joined);
        $encrypted = crypt($reversed, self::CRYPT_BLOWFISH_KEY);
        return $encrypted;
    }

    protected function _setCookie(GenericUserAccount $user, $loginKey, $checksum)
    {
        $user_id = $user->getUserId();
        $name = $user->getName();
        $address = $user->getAddress();
        $division_id = $user->getDivisionId();
        $group_id = $user->getGroupId();

        $joined = $user_id.'|'.$name.'|'.$address.'|'.$division_id.'|'.$group_id.'|'.$loginKey;

        // PK | 名前 | ログインキーの 暗号化
        $cryptUtils = new OpensslCryptUtils();
        $encrypted = $cryptUtils->encrypt($joined, self::CRYPT_PASSWORD);
        $encryptedAccountInfo = $encrypted['encrypt'].'|'.$encrypted['iv'];

        // Cookieにセット
        \Cookie::queue(cookie()->forever(self::COOKIE_ACCOUNT_INFOS_AES256, $encryptedAccountInfo));
        \Cookie::queue(cookie()->forever(self::COOKIE_CHECKSUM, $checksum));
    }

    protected function _setSession(GenericUserAccount $user, $loginKey, $checksum)
    {
        $user_id = $user->getUserId();
        $name = $user->getName();
        $address = $user->getAddress();
        $division_id = $user->getDivisionId();
        $group_id = $user->getGroupId();

        // セッション(Redis)に格納
        \Redis::setex($checksum.self::REDIS_USER_ID, self::EXPIRE_DATA_ON_SERVER, serialize($user_id));
        \Redis::setex($checksum.self::REDIS_USER_NAME, self::EXPIRE_DATA_ON_SERVER, serialize($name));
        \Redis::setex($checksum.self::REDIS_USER_ADDRESS, self::EXPIRE_DATA_ON_SERVER, serialize($address));
        \Redis::setex($checksum.self::REDIS_USER_DIVISION_ID, self::EXPIRE_DATA_ON_SERVER, serialize($division_id));
        \Redis::setex($checksum.self::REDIS_USER_GROUP_ID, self::EXPIRE_DATA_ON_SERVER, serialize($group_id));
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

        $user_id = $this->_getRedisKey($checkSumInCookie.self::REDIS_USER_ID);
        $user_name = $this->_getRedisKey($checkSumInCookie.self::REDIS_USER_NAME);
        $user_address = $this->_getRedisKey($checkSumInCookie.self::REDIS_USER_ADDRESS);
        $login_key = $this->_getRedisKey($checkSumInCookie.self::REDIS_LOGIN_KEY);

        $checkSum = $this->_encryptBlowfishWithAccountInfo($user_id, $user_name, $user_address, $login_key);

        // 突き合わせ
        if ($checkSumInCookie != $checkSum) {
            return false;
        }

        if (empty($this->user)) {
            $this->user = $this->provider->retrieveById($user_id);
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

        $user_id = \Arr::get($decrypted, 'user_id');
        $name = \Arr::get($decrypted, 'name');
        $address = \Arr::get($decrypted, 'address');
        $login_key = \Arr::get($decrypted, 'loginKey');

        $checkSum = $this->_encryptBlowfishWithAccountInfo($user_id, $name, $address, $login_key);
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

        $keys = ['user_id', 'name', 'address', 'division_id', 'group_id', 'loginKey'];
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
