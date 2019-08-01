<?php

namespace Rental\Services\Admin;

use Rental\Models\Admin\AddChargerData;

class AddChargerService
{
    protected $_model;

    public function __construct(AddChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData()
    {
        $data = [];
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

    public function registerData($param)
    {
        $rental_device_id = $this->_model->insertChargerData($param);
        return $rental_device_id;
    }
}
