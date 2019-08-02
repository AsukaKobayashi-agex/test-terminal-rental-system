<?php

namespace Rental\Services\User;

//use Rental\Models\_common\RentalHistoryData;
use Rental\Models\User\DetailPcData;

class DetailPcService
{
    protected $_model;
    protected $_history;

    public function __construct(DetailPcData $model/*,RentalHistoryData $history*/)
    {
        $this->_model = $model;
     //   $this->_history = $history;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail'] = $this->_model->getAllDetailPc($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['installed_software_list'] = $this->_model->getAllInstalledSoftware($param);
       // $data['recent_user'] = $this->_history->getOne($param['rental_device_id']);
        $data['recent_user'] = '';

        return $data;
    }
}
