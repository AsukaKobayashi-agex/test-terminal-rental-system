<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexArchivedRequest;
use Rental\Services\_common\ArchiveTrait;
use Rental\Services\Admin\Index\IndexArchivedService;


/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class IndexArchivedController extends Controller
{
    public function view(IndexArchivedRequest $request, IndexArchivedService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['search_id'] = $request -> input('search_id');
        return view('rental.admin.Device.index_archived')->with($data);
    }

    use ArchiveTrait;

    public function unsetArchive(IndexArchivedRequest $request)
    {
        $param = $request->all();
        $this->unset_archive($param['unset_device_id']);
        return redirect('/admin/archived')->with('success', 'アーカイブ状態を解除しました！');
    }
}
