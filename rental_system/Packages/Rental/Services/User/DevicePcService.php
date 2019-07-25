<?php

namespace Rental\Services\User;

use Rental\Models\User\DevicePcData;

class DevicePcService
{
    protected $_model;

    public function __construct(DevicePcData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $page_limit = 10;
        $data['pc_device_list'] = $this->_model->getAllDevicePc($param,$page_limit);
        $paginate = $this->_model->getAllDevicePc($param,0);
        $paginate = count($paginate);
        $data['page_num'] = ceil($paginate / $page_limit);

        return $data;
    }
}
