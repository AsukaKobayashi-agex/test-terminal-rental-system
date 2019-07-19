<?php

namespace Rental\Services\User\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use Rental\Models\_common\UserData;
use Rental\Services\User\Auth\GenericUserAccount;

class UserInfoProvider implements UserProvider
{
    protected $_model;

    public function __construct(UserData $model)
    {
        $this->_model = $model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $user_id
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($user_id)
    {
        $user_data = $this->_model->getUserAuthDataById($user_id);
        return new GenericUserAccount($user_data);
    }

    public function retrieveByToken($id, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        return;
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user_data = $this->_model->getUserAuthData($credentials);
        return new GenericUserAccount($user_data);
    }

    /**
     * ID/PWの妥当性チェック
     * @param Authenticatable $userAccount
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $userAccount, array $credentials)
    {
        $db_password = $userAccount->getAuthPassword();
        $password = \Arr::get($credentials, 'password');
        return ($db_password == $password);
    }
}
