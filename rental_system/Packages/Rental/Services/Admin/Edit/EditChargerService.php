<?php

namespace Rental\Services\Admin\Edit;

use Rental\Models\Admin\Edit\EditChargerData;

class EditChargerService
{
    protected $_model;

    public function __construct(EditChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllEditCharger($param);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

    public function registerData($param)
    {
        $this->_model->updateChargerData($param);
        return true;
    }
}
