<?php

namespace Rental\Models\_common;

class AdminAccountData
{
    const TABLE = 'admin_account';

    public function getAdminAuthData($credentials)
    {
        $result = \DB::table(self::TABLE)
            ->select(
                'admin_account_id',
                'name',
                'password',
                'address'
            )
            ->where('address', \Arr::get($credentials, 'address'))
            ->where('password', \Arr::get($credentials, 'password'))
            ->first();
        return stdClassToArray($result);
    }

    public function getUserAuthDataById($admin_account_id)
    {
        $result = \DB::table(self::TABLE)
            ->select(
                'admin_account_id',
                'name',
                'password',
                'address'
            )
            ->where('admin_account_id', $admin_account_id)
            ->first();
        return stdClassToArray($result);
    }
}
