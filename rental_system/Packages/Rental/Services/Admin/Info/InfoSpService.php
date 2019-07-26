<?php

namespace Rental\Services\Admin\Info;

use Rental\Models\_common\MobileAppMasterData;
use Rental\Models\_common\MobileCarrierData;
use Rental\Models\Admin\Info\InfoSpData;

class InfoSpService
{
    protected $_model;

    public function __construct(InfoSpData $model,MobileAppMasterData $_mobile_app_master,MobileCarrierData $_mobile_carrier)
    {
        $this->_model = $model;
        $this->_mobile_app_master = $_mobile_app_master;
        $this->_mobile_carrier = $_mobile_carrier;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllInfoSp($param);
        $data['installed_app'] = $this->_model->getAllInstalledApp($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['detail']['admin_memo'] = nl2br($data['detail']['admin_memo']);
        $data['mobile_carrier'] = $this->_mobile_carrier->getAll();
        $data['mobile_app_master'] = $this->_mobile_app_master->getEdit();
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

}
