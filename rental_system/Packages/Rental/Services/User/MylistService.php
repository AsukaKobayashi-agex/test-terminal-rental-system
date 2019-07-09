<?php

namespace Rental\Services\User;

use Rental\Models\User\MylistData;

class MylistService
{
    protected $_model;

    public function __construct(MylistData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $data['all_mylist_device'] = $this->_model->getAllMylistDevice($param);
        $data['all_mylist'] = $this->_model->getAllMylist($param);
        return $data;
    }

    public function deleteMylistDevice($param)
    {
        $this->_model->deleteMylistDevice($param);
        return true;
    }

    public function renameMylist($param)
    {
        $this->_model->renameMylist($param);
        return true;
    }

}
