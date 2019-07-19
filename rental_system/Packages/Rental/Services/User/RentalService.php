<?php

namespace Rental\Services\User;

use Rental\Models\User\RentalData;

class RentalService
{
    protected $_model;

    public function __construct(RentalData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        if(\Auth::guard('user')->check()){
            $data['user_info'] = $this->_model->getUserInfo($param);
        }
        $data['rental_device_list'] = $this->_model->getAllRentalDevice($param);
        return $data;
    }

    public function rentalDevice($param)
    {
        $this->_model->rentalDevice($param);
        return true;
    }

}
