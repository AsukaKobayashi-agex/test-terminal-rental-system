<?php

namespace Rental\Services\User;

use Rental\Models\User\RentalDeviceData;

class RentalDeviceService
{
    protected $_model;

    public function __construct(RentalDeviceData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['all_device_list'] = $this->_model->getAllRentalDevice($param);
        return $data;
    }
}
