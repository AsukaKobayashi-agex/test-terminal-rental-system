<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\TopRequest;
use Rental\Services\User\TopService;

/**
 * ユーザー画面TOP
 *
 * Class TopController
 * @package Rental\Http\Controllers\User
 */
class TopController extends Controller
{
    public function index(TopRequest $request, TopService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.top.index')->with($data);
    }
    public function login()
    {
        return view('rental.user.top.login');
    }

    public function sign_up()
    {
        return view('rental.user.top.sign_up');
    }

    public function mylist()
    {
        return view('rental.user.top.mylist');
    }

    public function detail()
    {
        return view('rental.user.top.detail');
    }

    public function users_guide()
    {
        return view('rental.user.top.users_guide');
    }

    public function pc()
    {
        return view('rental.user.top.pc');
    }

    public function charger()
    {
        return view('rental.user.top.charger');
    }


    public function sp()
    {
        return view('rental.user.top.sp');
    }


    public function tablet()
    {
        return view('rental.user.top.tablet');
    }

    public function rent_user()
    {
        return view('rental.user.top.rent_user');
    }

    public function rental()
    {
        return view('rental.user.top.rental');
    }

    public function return()
    {
        return view('rental.user.top.return');
    }

    public function profile()
    {
        return view('rental.user.top.profile');
    }

    public function mylist_register()
    {
        return view('rental.user.top.mylist_register');
    }
}
