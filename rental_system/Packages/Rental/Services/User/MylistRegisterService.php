<?php

namespace Rental\Services\User;

use Rental\Models\User\MylistRegisterData;

class MylistRegisterService
{
    protected $_model;

    public function __construct(MylistRegisterData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        if(\Auth::guard('user')->check()){
            $data['user_info'] = $this->_model->getUserInfo($param);
        }
        $data['register_device_list'] = $this->_model->getAllRegisterDevice($param);
        $data['all_mylist'] = $this->_model->getAllMylistRegister($param);
        return $data;
    }

    public function registerDevice($param)
    {
        $this->_model->registerDevice($param);
        return true;
    }

}
