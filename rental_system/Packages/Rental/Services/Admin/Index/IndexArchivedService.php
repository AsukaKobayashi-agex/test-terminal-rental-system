<?php

namespace Rental\Services\Admin\Index;

use Rental\Models\Admin\Index\IndexArchivedData;
use Rental\Services\_common\PaginateTrait;

class IndexArchivedService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(IndexArchivedData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getIndexArchived($param,0);
        $data += $this->paginate($all_num);
        $data['all_device_list'] = $this->_model->getIndexArchived($param,$data['limit']);
        if(\Auth::guard('admin')->check()) {
            $data['admin_info'] = $this->_model->getAdminAccountData();
        }
        return $data;
    }
}
