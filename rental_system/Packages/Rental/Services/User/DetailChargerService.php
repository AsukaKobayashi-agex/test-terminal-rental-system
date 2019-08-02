<?php

namespace Rental\Services\User;

//use Rental\Models\_common\RentalHistoryData;
use Rental\Models\User\DetailChargerData;

class DetailChargerService
{
    protected $_model;
    protected $_history;

    public function __construct(DetailChargerData $model/*,RentalHistoryData $history*/)
    {
        $this->_model = $model;
       // $this->_history = $history;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllDetailCharger($param);
       // $data['recent_user'] = $this->_history->getOne($param['rental_device_id']);
        $data['recent_user'] = '';
        return $data;
    }
}
