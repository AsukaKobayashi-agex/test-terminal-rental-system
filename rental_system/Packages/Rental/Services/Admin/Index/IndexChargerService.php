<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexChargerData;

class IndexChargerService
{
    protected $_model;

    public function __construct(IndexChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['charger_list'] = $this->_model->getAllIndexCharger($param);
        return $data;
    }
}
