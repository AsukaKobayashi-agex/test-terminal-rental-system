<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DetailPcRequest;
use Rental\Services\User\DetailPcService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class DetailPcController extends Controller
{
    public function detail_pc(DetailPcRequest $request, DetailPcService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.device.detail.detail_pc')->with($data);
    }
}
