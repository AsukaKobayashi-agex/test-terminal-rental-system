<?php

namespace Rental\Services\User;

use Rental\Models\User\DevicePcData;

class DevicePcService
{
    protected $_model;
    protected $_paginate;

    public function __construct(DevicePcData $model,PaginateService $paginateService)
    {
        $this->_model = $model;
        $this->_paginate = $paginateService;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllDevicePc($param,0);
        $data += $this->_paginate->paginate($all_num);
        $data['pc_device_list'] = $this->_model->getAllDevicePc($param,$data['limit']);

        return $data;
    }
}
