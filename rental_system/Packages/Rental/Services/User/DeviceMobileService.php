<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceMobileData;

class DeviceMobileService
{
    protected $_model;
    protected $_paginate;

    public function __construct(DeviceMobileData $model,PaginateService $paginateService)
    {
        $this->_model = $model;
        $this->_paginate = $paginateService;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllDeviceMobile($param,0);
        $data += $this->_paginate->paginate($all_num);
        $data['mobile_device_list'] = $this->_model->getAllDeviceMobile($param,$data['limit']);

        return $data;
    }
}
