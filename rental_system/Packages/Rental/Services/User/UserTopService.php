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
        $data['all_device_list'] = $this->_model->getAllUserTop($param);
        $data['user_info'] = $this->_model->getUserInfo($param);
        return $data;
    }
}
