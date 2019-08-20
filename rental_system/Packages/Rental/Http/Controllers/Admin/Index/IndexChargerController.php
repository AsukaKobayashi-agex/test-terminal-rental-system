<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexChargerRequest;
use Rental\Services\_common\ArchiveTrait;
use Rental\Services\Admin\Index\IndexChargerService;

class IndexChargerController extends Controller
{
    public function view(IndexChargerRequest $request, IndexChargerService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_id'] = $request -> input('search_id');
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['charger_type'] = $request -> input('charger_type');
        return view('rental.admin.Device.index_charger')->with($data);
    }

    use ArchiveTrait;

    public function setArchive(IndexChargerRequest $request)
    {
        $param = $request->all();
        $this->archive($param['set_device_id']);
        return redirect('/admin/index_charger')->with('success', 'アーカイブしました！');
    }

}
