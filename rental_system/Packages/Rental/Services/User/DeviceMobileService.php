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
        $page_limit = 10;
        $data['mobile_device_list'] = $this->_model->getAllDeviceMobile($param,$page_limit);
        $paginate = $this->_model->getAllDeviceMobile($param,0);
        $paginate = count($paginate);
        $data['page_num'] = ceil($paginate / $page_limit);

        return $data;
    }
}
