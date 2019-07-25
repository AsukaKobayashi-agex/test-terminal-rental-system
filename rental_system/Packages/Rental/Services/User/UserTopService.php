<?php

namespace Rental\Services\User;

use Rental\Models\User\UserTopData;

class UserTopService
{
    protected $_model;
    protected $_paginate;

    public function __construct(UserTopData $model,PaginateService $paginateService)
    {
        $this->_model = $model;
        $this->_paginate = $paginateService;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllUserTop($param,0);
        $data += $this->_paginate->paginate($all_num);
        $data['all_device_list'] = $this->_model->getAllUserTop($param,$data['limit']);

        return $data;
    }
}
