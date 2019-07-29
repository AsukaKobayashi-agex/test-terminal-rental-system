<?php

namespace Rental\Services\Admin\Master;

use Rental\Models\_common\MobileAppMasterData;
use Rental\Models\_common\PcSoftwareMasterData;

class MasterService
{
    protected $_mobile_app;
    protected $_software;

    public function __construct(MobileAppMasterData $mobile_app,PcSoftwareMasterData $software)
    {
        $this->_mobile_app = $mobile_app;
        $this->_software = $software;
    }

    public function getData()
    {
        $data = [];
        $data['all_mobile_app'] = $this->_mobile_app->getAll();
        $data['all_software'] = $this->_software->getAll();
        return $data;
    }

    public function delete_app($param)
    {
        $this->_mobile_app->delete_app($param['mobile_app_id']);
        return true;
    }

    public function add_app($param)
    {
        $this->_mobile_app->insertMobileAppMaster($param);
        return true;
    }

    public function rename_app($param)
    {
        $this->_mobile_app->rename_app($param);
        return true;
    }

    public function delete_software($param)
    {
        $this->_software->delete($param['software_id']);
        return true;
    }

    public function add_software($param)
    {
        $this->_software->insertPcSoftwareMaster($param);
        return true;
    }

    public function rename_software($param)
    {
        $this->_software->rename($param);
        return true;
    }
}
