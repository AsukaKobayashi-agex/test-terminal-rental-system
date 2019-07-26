<?php

namespace Rental\Services\User;

use Rental\Models\User\DeviceMobileData;
use Rental\Services\_common\PaginateTrait;

class DeviceMobileService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(DeviceMobileData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllDeviceMobile($param,0);
        $data += $this->paginate($all_num);
        $data['mobile_device_list'] = $this->_model->getAllDeviceMobile($param,$data['limit']);

        return $data;
    }
}
