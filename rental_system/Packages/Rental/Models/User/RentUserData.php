<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class RentUserData
{
    protected $_get_user_info;
    public function __construct(GetUserInfo $userInfo)
    {
        $this->_get_user_info = $userInfo;
    }

    public function getRentUserInfo($param){
        $rent_user_info = $this -> _get_user_info -> getUserInfo($param);

        return $rent_user_info;
    }

}
