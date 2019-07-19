<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\SignUpRequest;
use Rental\Services\User\SignUpService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class SignUpController extends Controller
{
    public function view()
    {
        return view('rental.user.auth.sign_up');
    }

    public function sign_up_confirm(SignUpRequest $request)
    {
        $param = $request->all();
        return view('rental.user.auth.sign_up_confirm')->with('input',$param);
    }

    public function sign_up(SignUpRequest $request,SignUpService $service)
    {
        $param = $request->all();
        $service->createNewAccount($param);
        if (!\Auth::guard('user')->attempt($param)) {
            // ログイン失敗
            return redirect()->back();
        }
        // ログイン成功
        return redirect('/')->with('flash_message','アカウントが作成されました');
    }
}
