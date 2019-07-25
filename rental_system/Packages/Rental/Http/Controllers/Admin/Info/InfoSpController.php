<?php

namespace Rental\Http\Controllers\Admin\Info;

use App\Http\Controllers\Controller;
use Rental\Services\Admin\Info\InfoSpService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class InfoSpController extends Controller
{
    public function view(InfoSpService $service)
    {
        $param = \Request::all();
        $data = $service->getData($param);
        return view('rental.admin.Device.info_sp')->with($data);
    }

}
