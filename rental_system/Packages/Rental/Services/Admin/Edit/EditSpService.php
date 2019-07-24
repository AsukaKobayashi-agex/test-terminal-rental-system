<?php

namespace Rental\Services\Admin\Edit;

use Rental\Models\_common\MobileAppMasterData;
use Rental\Models\_common\MobileCarrierData;
use Rental\Models\ADmin\Edit\EditSpData;

class EditSpService
{
    protected $_model;

    public function __construct(EditSpData $model,MobileAppMasterData $_mobile_app_master,MobileCarrierData $_mobile_carrier)
    {
        $this->_model = $model;
        $this->_mobile_app_master = $_mobile_app_master;
        $this->_mobile_carrier = $_mobile_carrier;
    }

    public function getData($param)
    {
        $data = [];
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['detail'] = $this->_model->getAllEditSp($param);
        $data['installed_app'] = $this->_model->getAllInstalledApp($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['mobile_carrier'] = $this->_mobile_carrier->getAll();
        $data['mobile_app_master'] = $this->_mobile_app_master->getEdit();
        return $data;
    }

    public function registerData($param)
    {
        $this->_model->updateSpData($param);
        return true;
    }
}
