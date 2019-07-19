<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexSpRequest;
use Rental\Services\Admin\Index\IndexSpService;


/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class IndexSpController extends Controller
{
    public function view(IndexSpRequest $request, IndexSpService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_id'] = $request -> input('search_id');
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['wifi'] = $request -> input('wifi');
        $data['com_line'] = $request -> input('com_line');
        $data['type'] = $request -> input('type');
        $data['os'] = $request -> input('os');
        $data['os_version'] = $request -> input('os_version');
        $data['search_carrier'] = $request -> input('search_carrier');
        return view('rental.admin.Device.index_sp')->with($data);
    }
}
