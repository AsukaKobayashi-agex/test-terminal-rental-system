<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceChargerData;

class DeviceChargerService
{
    protected $_model;

    public function __construct(DeviceChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['charger_list'] = $this->_model->getAllDeviceCharger($param);
        return $data;
    }
}
