<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class UserProfileData
{
    public function changeUserProfile($param){
        $update_data = [
            'name' => $param['name'],
            'division_id' => $param['division_id'],
            'group_id' => $param['group_id'],
            'address' => $param['address']
        ];

        \DB::table('user')->where('user_id', \Auth::guard('user')->id())->update($update_data);

        return true;
    }

}
