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
        if(\Auth::guard('user')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        $data['detail'] = $this->_model->getAllEditCharger($param);
        return $data;
    }
}
