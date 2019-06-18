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
}
