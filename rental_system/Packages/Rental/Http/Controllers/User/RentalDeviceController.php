<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\RentalDeviceRequest;
use Rental\Services\User\RentalDeviceService;


/**
 * ユーザー画面TOP
 *
 * Class RentalDeviceController
 * @package Rental\Http\Controllers\User
 */
class RentalDeviceController extends Controller
{
    public function index(RentalDeviceRequest $request, RentalDeviceService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.top.index')->with($data);
    }
}
