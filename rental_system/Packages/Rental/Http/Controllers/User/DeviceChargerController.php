<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DeviceChargerRequest;
use Rental\Services\User\DeviceChargerService;

/**
 * ユーザー画面TOP
 *
 * Class DeviceChargerController
 * @package Rental\Http\Controllers\User
 */
class DeviceChargerController extends Controller
{
    public function charger(DeviceChargerRequest $request, DeviceChargerService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['charger_type'] = $request -> input('charger_type');
        return view('rental.user.device.charger.charger')->with($data);
    }
}
