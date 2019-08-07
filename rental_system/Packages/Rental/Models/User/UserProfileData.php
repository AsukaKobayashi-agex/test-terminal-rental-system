<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class UserProfileData
{
    public function changeUserProfile($param){
        $now = nowDateTime();
        $update_data = [
            'name' => mb_convert_kana($param['name'],"KVnr"),
            'division_id' => $param['division_id'],
            'group_id' => $param['group_id'],
            'address' => $param['address'],
            'update_date' => $now
        ];

        \DB::table('user')->where('user_id', \Auth::guard('user')->id())->update($update_data);

        return true;
    }

}
