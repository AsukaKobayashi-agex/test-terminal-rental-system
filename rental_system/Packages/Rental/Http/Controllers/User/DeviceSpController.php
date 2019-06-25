<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DeviceSpRequest;
use Rental\Services\User\DeviceSpService;


/**
 * ユーザー画面TOP
 *
 * Class RentalDeviceController
 * @package Rental\Http\Controllers\User
 */
class DeviceSpController extends Controller
{
    public function smart_phone(DeviceSpRequest $request, DeviceSpService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.category.smart_phone')->with($data);
    }
}
