<?php

namespace Rental\Services\User;

use Rental\Models\User\SignUpData;

class SignUpService
{
    protected $_model;

    public function __construct(SignUpData $model)
    {
        $this->_model = $model;
    }

    public function createNewAccount($param)
    {
        $this->_model->createAccount($param);

        return true;
    }
}
