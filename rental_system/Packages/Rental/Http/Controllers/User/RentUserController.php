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
class RentUserController extends Controller
{
    public function rent_user()
    {
        return view('rental.user.rent_user');
    }
}
