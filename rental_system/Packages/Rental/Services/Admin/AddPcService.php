<?php

namespace Rental\Services\Admin;

use Rental\Models\_common\PcSoftwareMasterData;
use Rental\Models\Admin\AddPcData;

class AddPcService
{
    protected $_software_master;
    protected $_add_model;

    public function __construct(PcSoftwareMasterData $software_master, AddPcData $add_model)
    {
        $this->_software_master = $software_master;
        $this->_add_model = $add_model;
    }

    public function getFormData()
    {
        $ret = [];
        $ret['software_master'] = $this->_software_master->getAll();
        if(\Auth::guard('user')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $ret;
    }

    public function registerData($param)
    {
        $rental_device_id = $this->_add_model->insertPcData($param);
        return $rental_device_id;
    }
}
