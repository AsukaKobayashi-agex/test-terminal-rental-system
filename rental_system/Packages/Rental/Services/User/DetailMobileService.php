<?php

namespace Rental\Services\User;

use Rental\Models\User\DetailMobileData;

class DetailMobileService
{
    protected $_model;

    public function __construct(DetailMobileData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['detail_list'] = $this->_model->getAllDetailMobile($param);
        $data['installed_app_list'] = $this->_model->getAllInstalledApp($param);
        return $data;
    }
}
