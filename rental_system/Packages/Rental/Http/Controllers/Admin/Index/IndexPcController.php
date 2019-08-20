<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexPcRequest;
use Rental\Services\_common\ArchiveTrait;
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
        $data['search_id'] = $request -> input('search_id');
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['os'] = $request -> input('os');
        $data['os_version'] = $request -> input('os_version');
        $data['search_account'] = $request -> input('search_account');
        return view('rental.admin.Device.index_pc')->with($data);
    }


    use ArchiveTrait;

    public function setArchive(IndexPcRequest $request)
    {
        $param = $request->all();
        $this->archive($param['set_device_id']);
        return redirect('/admin/index_pc')->with('success', 'アーカイブしました！');
    }

}
