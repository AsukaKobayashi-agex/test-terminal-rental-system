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
        $ret = [];
        $ret['mobile_carrier'] = $this->_mobile_carrier->getAll();
        $ret['mobile_app_master'] = $this->_mobile_app_master->getAll();
        return $ret;
    }

    public function registerData($param)
    {
        $this->_model->insertSpData($param);
        return true;
    }
}
