<?php

namespace Rental\Services\User;

use Rental\Models\User\DevicePcData;
use Rental\Services\_common\PaginateTrait;

class DevicePcService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(DevicePcData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllDevicePc($param,0);
        $data += $this->paginate($all_num);
        $data['pc_device_list'] = $this->_model->getAllDevicePc($param,$data['limit']);

        return $data;
    }
}
