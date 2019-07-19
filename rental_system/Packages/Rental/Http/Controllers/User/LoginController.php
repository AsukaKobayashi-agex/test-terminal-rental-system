<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\LoginRequest;
use App\Http\Middleware\Authenticate;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class LoginController extends Controller
{
    public function login()
    {
        return view('rental.user.auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $param = $request->all();
        if (!\AUth::guard('user')->attempt($param)) {
            // ログイン失敗
            return redirect()->back();
        }
        // ログイン成功
        return redirect()->route('user.mylist');
    }
}
