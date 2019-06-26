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
class RentalController extends Controller
{
    public function rental()
    {
        return view('rental.user.rental');
    }
}
