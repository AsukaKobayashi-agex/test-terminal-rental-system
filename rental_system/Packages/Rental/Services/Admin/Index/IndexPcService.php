<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexPcData;
use Rental\Services\_common\PaginateTrait;

class IndexPcService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(IndexPcData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllIndexPc($param,0);
        $data += $this->paginate($all_num);
        $data['pc_device_list'] = $this->_model->getAllIndexPc($param,$data['limit']);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }
}
