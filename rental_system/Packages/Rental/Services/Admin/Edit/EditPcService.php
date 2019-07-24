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
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['detail'] = $this->_model->getAllEditPc($param);
        $data['installed_software'] = $this->_model->getAllInstalledSoftware($param);
        $data['software_master'] = $this->_software_master->getEdit();
        return $data;
    }

    public function registerData($param)
    {
        $this->_model->updatePcData($param);
        return true;
    }
}
