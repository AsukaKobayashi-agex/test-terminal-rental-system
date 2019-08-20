<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexAllRequest;
use Rental\Services\_common\ArchiveTrait;
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
        return view('rental.admin.Device.index_all')->with($data);
    }

    use ArchiveTrait;

    public function setArchive(IndexAllRequest $request)
    {
        $param = $request->all();
        $this->archive($param['set_device_id']);
        return redirect('/admin/index_all')->with('success', 'アーカイブしました！');
    }
}
