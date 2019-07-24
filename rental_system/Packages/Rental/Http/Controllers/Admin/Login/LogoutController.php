<?php

namespace Rental\Http\Controllers\Admin\Login;

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
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

}
