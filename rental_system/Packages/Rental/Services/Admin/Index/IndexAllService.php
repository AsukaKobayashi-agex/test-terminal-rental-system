<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexAllData;

class IndexAllService
{
    protected $_model;

    public function __construct(IndexAllData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['all_device_list'] = $this->_model->getIndexAll($param);
        return $data;
    }
}