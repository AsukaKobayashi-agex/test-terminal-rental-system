<?php

namespace Rental\Services\Admin;

use Rental\Models\Admin\AddChargerData;

class AddChargerService
{
    protected $_model;

    public function __construct(AddChargerData $model)
    {
        $this->_model = $model;
    }

    public function registerData($param)
    {
        $this->_model->insertChargerData($param);
        return true;
    }
}
