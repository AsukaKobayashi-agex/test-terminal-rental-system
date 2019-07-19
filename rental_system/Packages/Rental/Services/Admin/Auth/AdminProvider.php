<?php

namespace Rental\Services\Admin\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

use Rental\Models\_common\AdminAccountData;
use Rental\Services\Admin\Auth\GenericAdminAccount;

class AdminProvider implements UserProvider
{
    protected $_model;

    public function __construct(AdminAccountData $model)
    {
        $this->_model = $model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $admin_account_id
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($admin_account_id)
    {
        $admin_data = $this->_model->getUserAuthDataById($admin_account_id);
        return new GenericAdminAccount($admin_data);
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
        $user_data = $this->_model->getAdminAuthData($credentials);
        return new GenericAdminAccount($user_data);
    }

    /**
     * ID/PWの妥当性チェック
     * @param Authenticatable $adminAccount
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $adminAccount, array $credentials)
    {
        $db_password = $adminAccount->getAuthPassword();
        $password = \Arr::get($credentials, 'password');
        return ($db_password == $password);
    }
}
