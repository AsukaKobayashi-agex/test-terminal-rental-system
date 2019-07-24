<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class RentUserData
{
    public function getRentUserInfo($param){
        $rent_user_info = $this -> _get_user_info -> getUserInfo($param);

        return $rent_user_info;
    }

}
