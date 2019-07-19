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
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['detail'] = $this->_model->getAllEditCharger($param);
        return $data;
    }
}
