<?php

namespace Rental\Services\Admin;

class TopService
{
    public function __construct()
    {

    }

    public function getData($param)
    {
        return $param + ['data' => 'test'];
    }
}
