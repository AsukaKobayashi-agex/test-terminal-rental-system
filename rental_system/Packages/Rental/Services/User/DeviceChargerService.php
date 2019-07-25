<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceChargerData;

class DeviceChargerService
{
    protected $_model;
    protected $_paginate;

    public function __construct(DeviceChargerData $model,PaginateService $paginateService)
    {
        $this->_model = $model;
        $this->_paginate = $paginateService;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllDeviceCharger($param,0);
        $data += $this->_paginate->paginate($all_num);
        $data['charger_list'] = $this->_model->getAllDeviceCharger($param,$data['limit']);

        return $data;
    }
}
