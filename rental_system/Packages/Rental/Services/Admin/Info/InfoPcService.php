<?php

namespace Rental\Services\Admin\Info;

use Rental\Models\_common\PcSoftwareMasterData;
//use Rental\Models\_common\RentalHistoryData;
use Rental\Models\Admin\Info\InfoPcData;

class InfoPcService
{
    protected $_model;
    protected $_software_master;
    protected $_history;

    public function __construct(InfoPcData $model,PcSoftwareMasterData $software_master/*,RentalHistoryData $history*/)
    {
        $this->_software_master = $software_master;
        $this->_model = $model;
        //$this->_history = $history;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllInfoPc($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['detail']['admin_memo'] = nl2br($data['detail']['admin_memo']);
        $data['installed_software'] = $this->_model->getAllInstalledSoftware($param);
        $data['software_master'] = $this->_software_master->getAll();
        //$data['recent_user'] = $this->_history->getOne($param['rental_device_id']);
        $data['recent_user'] = '';
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

}
