<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceSpData;

class DeviceSpService
{
    protected $_model;

    public function __construct(DeviceSpData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['all_device_list'] = $this->_model->getAllDeviceSp($param);
        return $data;
    }
}
