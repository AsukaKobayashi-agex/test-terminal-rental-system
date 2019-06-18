<?php

namespace Rental\Services\User;

use Rental\Models\User\TopData;

class TopService
{
    protected $_model;

    public function __construct(TopData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['all_device_list'] = $this->_model->getAllRentalDevice();
        return $data;
    }
}
