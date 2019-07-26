<?php

namespace Rental\Services\User;

use Rental\Models\User\UserTopData;
use Rental\Services\_common\PaginateTrait;

class UserTopService
{
    protected $_model;
    use PaginateTrait;

    public function __construct(UserTopData $model)
    {
        $this->_model = $model;
    }

    public function getData($param)
    {
        $data = [];
        $all_num = $this->_model->getAllUserTop($param,0);
        $data += $this->paginate($all_num);
        $data['all_device_list'] = $this->_model->getAllUserTop($param,$data['limit']);

        return $data;
    }
}
