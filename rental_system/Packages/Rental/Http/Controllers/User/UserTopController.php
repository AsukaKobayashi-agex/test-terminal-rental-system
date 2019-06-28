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
class UserTopController extends Controller
{
    public function index(UserTopRequest $request, UserTopService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.top.index')->with($data);
    }
}
