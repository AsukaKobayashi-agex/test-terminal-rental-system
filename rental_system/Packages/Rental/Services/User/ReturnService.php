<?php

namespace Rental\Services\User;

use Rental\Models\User\ReturnData;

class ReturnService
{
    protected $_model;

    public function __construct(ReturnData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['return_device_list'] = $this->_model->getAllReturnDevice($param);
        return $data;
    }

    public function returnDevice($param)
    {
        $this->_model->returnDevice($param);
        return true;
    }

}
