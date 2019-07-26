<?php

namespace Rental\Services\Admin\Edit;

use Rental\Models\_common\PcSoftwareMasterData;
use Rental\Models\Admin\Edit\EditPcData;

class EditPcService
{
    protected $_model;

    public function __construct(EditPcData $model,PcSoftwareMasterData $software_master)
    {
        $this->_software_master = $software_master;
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllEditPc($param);
        $data['installed_software'] = $this->_model->getAllInstalledSoftware($param);
        $data['software_master'] = $this->_software_master->getAll();
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

    public function registerData($param)
    {
        $this->_model->updatePcData($param);
        return true;
    }
}
