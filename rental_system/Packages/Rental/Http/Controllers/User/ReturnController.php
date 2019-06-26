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
class ReturnController extends Controller
{
    public function return()
    {
        return view('rental.user.return');
    }
}
