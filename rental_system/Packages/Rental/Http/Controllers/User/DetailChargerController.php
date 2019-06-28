<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\DetailChargerRequest;
use Rental\Services\User\DetailChargerService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class DetailChargerController extends Controller
{
    public function detail_charger(DetailChargerRequest $request, DetailChargerService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.device.detail.detail_charger')->with($data);
    }
}
