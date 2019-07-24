<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\LoginRequest;

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
        if (!\Auth::guard('user')->attempt($param)) {
            // ログイン失敗
            return redirect()->back()->with('loginError','ログイン情報が間違っています');
        }
        // ログイン成功
        return redirect()->route('user.mylist');
    }
}
