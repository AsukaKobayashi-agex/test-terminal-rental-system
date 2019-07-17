<?php

namespace Rental\Services\User;

use Rental\Models\User\UserTopData;

class UserTopService
{
    protected $_model;

    public function __construct(UserTopData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['all_device_list'] = $this->_model->getAllUserTop($param);
        return $data;
    }
}
