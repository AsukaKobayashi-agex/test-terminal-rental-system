<?php

namespace Rental\Services\Admin\Info;

//use Rental\Models\_common\RentalHistoryData;
use Rental\Models\Admin\Info\InfoChargerData;

class InfoChargerService
{
    protected $_model;
    protected $_history;

    public function __construct(InfoChargerData $model/*,RentalHistoryData $history*/)
    {
        $this->_model = $model;
        //$this->_history = $history;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllInfoCharger($param);
       // $data['recent_user'] = $this->_history->getOne($param['rental_device_id']);
        $data['recent_user'] = '';
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }

}
