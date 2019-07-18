<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexSpData;

class IndexSpService
{
    protected $_model;

    public function __construct(IndexSpData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['mobile_device_list'] = $this->_model->getAllIndexSp($param);
        return $data;
    }
}
