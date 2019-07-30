<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexChargerData;
use Rental\Services\_common\PaginateTrait;

class IndexChargerService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(IndexChargerData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllIndexCharger($param,0);
        $data += $this->paginate($all_num);
        $data['charger_list'] = $this->_model->getAllIndexCharger($param,$data['limit']);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }
}
