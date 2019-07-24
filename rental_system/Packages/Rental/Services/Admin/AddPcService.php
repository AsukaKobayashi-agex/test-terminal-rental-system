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
        $ret = [];
        $ret['software_master'] = $this->_software_master->getAdd();
        return $ret;
    }

    public function registerData($param)
    {
        $rental_device_id = $this->_model->insertPcData($param);
        return $rental_device_id;
    }
}
