<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceMobileData;

class DeviceMobileService
{
    protected $_model;

    public function __construct(DeviceMobileData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['mobile_device_list'] = $this->_model->getAllDeviceMobile($param);
        return $data;
    }
}
