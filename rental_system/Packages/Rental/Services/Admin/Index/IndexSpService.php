<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexSpData;
use Rental\Services\_common\PaginateTrait;

class IndexSpService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(IndexSpData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllIndexSp($param,0);
        $data += $this->paginate($all_num);
        $data['mobile_device_list'] = $this->_model->getAllIndexSp($param,$data['limit']);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }
}
