<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\RentUserRequest;
use Rental\Services\User\RentUserService;


/**
 * ユーザー画面TOP
 *
 * Class RentUserController
 * @package Rental\Http\Controllers\User
 */
class RentUserController extends Controller
{
    public function rent_user(RentUserRequest $request, RentUserService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.profile.rent_user')->with($data);
    }
}
