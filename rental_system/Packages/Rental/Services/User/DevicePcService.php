<?php

namespace Rental\Services\User;

use Rental\Models\User\DevicePcData;

class DevicePcService
{
    protected $_model;

    public function __construct(DevicePcData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['pc_device_list'] = $this->_model->getAllDevicePc($param);
        return $data;
    }
}
