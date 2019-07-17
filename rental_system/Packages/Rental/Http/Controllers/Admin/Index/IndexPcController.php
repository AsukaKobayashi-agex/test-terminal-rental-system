<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexPcRequest;
use Rental\Services\Admin\Index\IndexPcService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class IndexPcController extends Controller
{
    public function view(IndexPcRequest $request, IndexPcService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['os'] = $request -> input('os');
        $data['os_version'] = $request -> input('os_version');
        $data['pc_account_name'] = $request -> input('pc_account_name');
        return view('rental.admin.device.index_pc')->with($data);
    }
}
