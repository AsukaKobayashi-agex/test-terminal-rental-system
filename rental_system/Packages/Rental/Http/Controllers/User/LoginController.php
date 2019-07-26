<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Rental\Http\Requests\User\LoginRequest;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class LoginController extends Controller
{
    use RedirectsUsers;

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/mylist';
    }


    public function login()
    {
        session(['url.intended' => $_SERVER['HTTP_REFERER']]);
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
        return redirect()->intended($this->redirectPath());
    }
}
