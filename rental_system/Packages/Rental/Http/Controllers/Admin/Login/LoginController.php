<?php

namespace Rental\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Login\LoginRequest;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class LoginController extends Controller
{
    public function form()
    {
        return view('rental.admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $param = $request->all();
        if (!\AUth::guard('admin')->attempt($param)) {
            // ログイン失敗
            return redirect()->back()->with('loginError','ログイン情報が間違っています');
        }
        // ログイン成功
        return redirect('/admin/index_all/');
    }
}
