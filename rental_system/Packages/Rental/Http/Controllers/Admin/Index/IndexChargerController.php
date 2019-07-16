<?php

namespace Rental\Http\Controllers\Admin\Index;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Index\IndexChargerRequest;
use Rental\Services\Admin\Index\IndexChargerService;

class IndexChargerController extends Controller
{
    public function view(IndexChargerRequest $request, IndexChargerService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        $data['search_word'] = $request -> input('search_word');
        $data['status'] = $request -> input('status');
        $data['charger_type'] = $request -> input('charger_type');
        return view('rental.admin.device.index_charger')->with($data);
    }
}
