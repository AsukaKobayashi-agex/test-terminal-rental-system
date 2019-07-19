<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;

/**
 * ユーザー画面TOP
 *
 * Class LogoutController
 * @package Rental\Http\Controllers\User
 */
class LogoutController extends Controller
{
    public function logout()
    {
        \Auth::guard('user')->logout();
        return redirect('/');
    }

}
