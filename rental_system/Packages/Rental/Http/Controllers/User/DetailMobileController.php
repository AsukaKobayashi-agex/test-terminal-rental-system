<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DetailMobileRequest;
use Rental\Services\User\DetailMobileService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class DetailMobileController extends Controller
{
    public function detail_mobile(DetailMobileRequest $request, DetailMobileService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.device.detail.detail_mobile')->with($data);
    }
}
