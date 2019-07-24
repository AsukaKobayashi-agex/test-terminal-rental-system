<?php

namespace Rental\Services\Admin;

use Rental\Models\_common\PcSoftwareMasterData;
use Rental\Models\Admin\AddPcData;

class AddPcService
{
    protected $_software_master;
    protected $_model;

    public function __construct(PcSoftwareMasterData $software_master, AddPcData $add_model)
    {
        $this->_software_master = $software_master;
        $this->_model = $add_model;
    }

    public function getFormData()
    {
        $data = [];
        $data['software_master'] = $this->_software_master->getAll();
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

    public function registerData($param)
    {
        $rental_device_id = $this->_model->insertPcData($param);
        return $rental_device_id;
    }
}
