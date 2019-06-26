<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\TopRequest;
use Rental\Services\Admin\TopService;

/**
 * 管理画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\Admin
 */
class TopController extends Controller
{
    public function index(TopRequest $request, TopService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.admin.top.index')->with($data);
    }
}
