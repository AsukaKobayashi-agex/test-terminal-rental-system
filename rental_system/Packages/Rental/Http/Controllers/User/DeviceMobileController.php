<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DeviceMobileRequest;
use Rental\Services\User\DeviceMobileService;


/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class DeviceMobileController extends Controller
{
    public function mobile(DeviceMobileRequest $request, DeviceMobileService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['wifi'] = $request -> input('wifi');
        $data['com_line'] = $request -> input('com_line');
        $data['type'] = $request -> input('type');
        $data['os'] = $request -> input('os');
        $data['os_version'] = $request -> input('os_version');
        return view('rental.user.device.mobile.mobile')->with($data);
    }
}
