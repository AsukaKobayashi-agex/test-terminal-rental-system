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
        $page_limit = 10;
        $data['charger_list'] = $this->_model->getAllDeviceCharger($param,$page_limit);
        $paginate = $this->_model->getAllDeviceCharger($param,0);
        $paginate = count($paginate);
        $data['page_num'] = ceil($paginate / $page_limit);

        return $data;
    }
}
