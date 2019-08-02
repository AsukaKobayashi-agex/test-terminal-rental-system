<?php

namespace Rental\Services\User;

//use Rental\Models\_common\RentalHistoryData;
use Rental\Models\User\DetailMobileData;

class DetailMobileService
{
    protected $_model;
    protected $_history;

    public function __construct(DetailMobileData $model/*,RentalHistoryData $history*/)
    {
        $this->_model = $model;
       // $this->_history = $history;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllDetailMobile($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['installed_app_list'] = $this->_model->getAllInstalledApp($param);
      //  $data['recent_user'] = $this->_history->getOne($param['rental_device_id']);
        $data['recent_user'] = '';
        return $data;
    }
}
