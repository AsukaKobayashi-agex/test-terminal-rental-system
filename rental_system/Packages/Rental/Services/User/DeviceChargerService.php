<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceChargerData;
use Rental\Services\_common\PaginateTrait;

class DeviceChargerService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(DeviceChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllDeviceCharger($param,0);
        $data += $this->paginate($all_num);
        $data['charger_list'] = $this->_model->getAllDeviceCharger($param,$data['limit']);

        return $data;
    }
}
