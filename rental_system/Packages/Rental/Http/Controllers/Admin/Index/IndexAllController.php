<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexAllRequest;
use Rental\Services\Admin\Index\IndexAllService;


/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class IndexAllController extends Controller
{
    public function view(IndexAllRequest $request, IndexAllService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['search_id'] = $request -> input('search_id');
        return view('rental.Admin.Device.index_all')->with($data);
    }
}
