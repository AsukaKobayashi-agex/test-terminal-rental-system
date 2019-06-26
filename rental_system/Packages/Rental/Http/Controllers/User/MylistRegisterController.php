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
class MylistRegisterController extends Controller
{
    public function mylist_register()
    {
        return view('rental.user.mylist_register');
    }
}
