<?php

namespace Rental\Http\Controllers\Admin\Info;

use App\Http\Controllers\Controller;
use Rental\Services\Admin\Info\InfoChargerService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class InfoChargerController extends Controller
{
    public function view(InfoChargerService $service)
    {
        $param = \Request::all();
        $data = $service->getData($param);
        return view('rental.admin.Device.info_charger')->with($data);
    }

}
