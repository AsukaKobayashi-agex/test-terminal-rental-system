<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\UserProfileRequest;
use Rental\Services\User\UserProfileService;


/**
 * ユーザー画面TOP
 *
 * Class UserProfileController
 * @package Rental\Http\Controllers\User
 */
class UserProfileController extends Controller
{
    public function user_profile(UserProfileRequest $request, UserProfileService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.profile.user_profile')->with($data);
    }

    public function change_profile(UserProfileRequest $request, UserProfileService $service)
    {
        $param = $request->all();
        $service->changeProfile($param);
        return redirect('/profile')->with('flash_message','プロフィールを保存しました');
    }
}
