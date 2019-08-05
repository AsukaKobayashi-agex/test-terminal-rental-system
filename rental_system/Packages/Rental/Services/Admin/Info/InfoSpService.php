<?php

namespace Rental\Services\Admin\Info;

use Rental\Models\_common\MobileAppMasterData;
use Rental\Models\_common\MobileCarrierData;
use Rental\Models\_common\RentalHistoryData;
use Rental\Models\Admin\Info\InfoSpData;

class InfoSpService
{
    protected $_model;
    protected $_mobile_app_master;
    protected $_mobile_carrier;
    protected $_history;

    public function __construct(InfoSpData $model,MobileAppMasterData $mobile_app_master,MobileCarrierData $mobile_carrier,RentalHistoryData $history)
    {
        $this->_model = $model;
        $this->_mobile_app_master = $mobile_app_master;
        $this->_mobile_carrier = $mobile_carrier;
        $this->_history = $history;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllInfoSp($param);
        $data['installed_app'] = $this->_model->getAllInstalledApp($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['detail']['admin_memo'] = nl2br($data['detail']['admin_memo']);
        $data['mobile_carrier'] = $this->_mobile_carrier->getAll();
        $data['mobile_app_master'] = $this->_mobile_app_master->getAll();
        $data['recent_user'] = $this->_history->getOne($param['rental_device_id']);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

}
