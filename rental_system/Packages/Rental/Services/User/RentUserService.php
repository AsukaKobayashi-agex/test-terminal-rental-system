<?php

namespace Rental\Services\User;

use Rental\Models\User\RentUserData;

class RentUserService
{
    protected $_model;

    public function __construct(RentUserData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['rent_user_info'] = $this->_model->getRentUserInfo($param);
        return $data;
    }
}
