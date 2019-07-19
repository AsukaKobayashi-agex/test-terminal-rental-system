<?php

namespace Rental\Services\User;

use Rental\Models\User\DetailPcData;

class DetailPcService
{
    protected $_model;

    public function __construct(DetailPcData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        if(\Auth::guard('user')->check()){
            $data['user_info'] = $this->_model->getUserInfo($param);
}
        $data['detail'] = $this->_model->getAllDetailPc($param);
        $data['detail']['memo'] = nl2br($data['detail']['memo']);
        $data['installed_software_list'] = $this->_model->getAllInstalledSoftware($param);
        return $data;
    }
}
