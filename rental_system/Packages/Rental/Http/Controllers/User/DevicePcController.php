<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DevicePcRequest;
use Rental\Services\User\DevicePcService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class DevicePcController extends Controller
{
    public function pc(DevicePcRequest $request, DevicePcService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['os'] = $request -> input('os');
        $data['os_version'] = $request -> input('os_version');
        return view('rental.user.device.pc.pc')->with($data);
    }
}
