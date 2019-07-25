<?php

namespace Rental\Services\Admin\Info;

use Rental\Models\Admin\Info\InfoChargerData;

class InfoChargerService
{
    protected $_model;

    public function __construct(InfoChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllInfoCharger($param);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

}
