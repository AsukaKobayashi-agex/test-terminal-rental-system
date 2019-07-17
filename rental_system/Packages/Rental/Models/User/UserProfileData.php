<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class UserProfileData
{
    protected $_get_user_info;
    public function __construct(GetUserInfo $userInfo)
    {
        $this->_get_user_info = $userInfo;
    }


    public function getUserInfo($param){
        $param['user_id'] = 1;
        $user_info = $this -> _get_user_info -> getUserInfo($param);

        return $user_info;
    }

    public function changeUserProfile($param){
        $update_data = [
            'name' => $param['name'],
            'division_id' => $param['division_id'],
            'group_id' => $param['group_id'],
            'address' => $param['address']
        ];

        \DB::table('user')->where('user_id', $param['user_id'])->update($update_data);

        return true;
    }

}
