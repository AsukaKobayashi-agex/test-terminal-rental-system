<?php

namespace Rental\Models\_common;

class UserData
{
    const TABLE = 'user';

    public function getUserAuthData($credentials)
    {
        $result = \DB::table(self::TABLE)
            ->select(
                'user_id',
                'name',
                'password',
                'address',
                'division_id',
                'group_id'
            )
            ->where('address', \Arr::get($credentials, 'address'))
            ->where('password', \Arr::get($credentials, 'password'))
            ->first();
        return stdClassToArray($result);
    }

    public function getUserAuthDataById($user_id)
    {
        $result = \DB::table(self::TABLE)
            ->select(
                'user_id',
                'name',
                'password',
                'address',
                'division_id',
                'group_id'
            )
            ->where('user_id', $user_id)
            ->first();
        return stdClassToArray($result);
    }
}
