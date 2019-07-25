<?php

namespace Rental\Services\User;

use Rental\Models\User\UserTopData;

class UserTopService
{
    protected $_model;

    public function __construct(UserTopData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $paginate = $this->_model->getAllUserTop($param,0);
        $page_limit = 10;
        $data['all_device_list'] = $this->_model->getAllUserTop($param,$page_limit);
        $paginate = count($paginate);
        $data['page_num'] = ceil($paginate / $page_limit);

        return $data;
    }
}
