<?php

namespace Rental\Services\Admin;

use Rental\Models\_common\MobileAppMasterData;
use Rental\Models\_common\MobileCarrierData;
use Rental\Models\Admin\AddSpData;

class AddSpService
{
    protected $_mobile_app_master;
    protected $_mobile_carrier;
    protected $_add_model;

    public function __construct(MobileAppMasterData $_mobile_app_master,MobileCarrierData $_mobile_carrier,AddSpData $_add_model)
    {
        $this->_mobile_app_master = $_mobile_app_master;
        $this->_mobile_carrier = $_mobile_carrier;
        $this->_model = $_add_model;
    }

    public function getFormData()
    {
        $data = [];
        $data['mobile_carrier'] = $this->_mobile_carrier->getAll();
        $data['mobile_app_master'] = $this->_mobile_app_master->getAll();
        if(\Auth::guard('user')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

    public function registerData($param)
    {
        $rental_device_id =  $this->_model->insertSpData($param);
        return $rental_device_id;
    }
}
