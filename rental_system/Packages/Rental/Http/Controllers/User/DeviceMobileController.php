<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DeviceMobileRequest;
use Rental\Services\User\DeviceMobileService;


/**
 * ユーザー画面TOP
 *
 * Class RentalDeviceController
 * @package Rental\Http\Controllers\User
 */
class DeviceMobileController extends Controller
{
    public function mobile(DeviceMobileRequest $request, DeviceMobileService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.category.mobile')->with($data);
    }
}
