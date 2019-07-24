<?php

namespace Rental\Services\User;

use Rental\Models\User\DetailChargerData;

class DetailChargerService
{
    protected $_model;

    public function __construct(DetailChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllDetailCharger($param);
        return $data;
    }
}
