<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexPcData;

class IndexPcService
{
    protected $_model;

    public function __construct(IndexPcData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['pc_device_list'] = $this->_model->getAllIndexPc($param);
        if(\Auth::guard('user')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }
}
