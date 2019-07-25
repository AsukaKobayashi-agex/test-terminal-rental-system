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
        $paginate = $this->_model->getAllDeviceMobile($param,1);
        $data['mobile_device_list'] = $this->_model->getAllDeviceMobile($param,0);
        $paginate = count($paginate);
        $data['page_num'] = ceil($paginate / 10);

        return $data;
    }
}
