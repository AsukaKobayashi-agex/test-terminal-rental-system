<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\UserTopRequest;
use Rental\Services\User\UserTopService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class MylistRegisterController extends Controller
{
    public function mylist_register()
    {
        return view('rental.user.mylist_register');
    }
}
