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
        $data['user_info'] = $this->_model->getUserInfo($param);
        $data['detail_list'] = $this->_model->getAllDetailPc($param);
        $data['installed_software_list'] = $this->_model->getAllInstalledSoftware($param);
        return $data;
    }
}
