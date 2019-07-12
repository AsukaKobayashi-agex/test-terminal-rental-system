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
        return $ret;
    }

    public function registerData($param)
    {
        $this->_add_model->insertPcData($param);
        return true;
    }
}
