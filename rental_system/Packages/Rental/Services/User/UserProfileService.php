<?php

namespace Rental\Services\User;

use Rental\Models\User\UserProfileData;

class UserProfileService
{
    protected $_model;

    public function __construct(UserProfileData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        return $data;
    }

    public function changeProfile($param)
    {
       $this->_model->changeUserProfile($param);
        return true;
    }
}
