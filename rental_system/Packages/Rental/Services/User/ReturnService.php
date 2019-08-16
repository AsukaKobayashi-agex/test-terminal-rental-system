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
        $data['return_device_list'] = $this->_model->getAllReturnDevice($param);
        return $data;
    }

    public function returnDevice($param)
    {
        $message = $this->_model->returnDevice($param);
        return $message;
    }

}
