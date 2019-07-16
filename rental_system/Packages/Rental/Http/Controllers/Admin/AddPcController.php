<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\AddPcRequest;
use Rental\Services\Admin\AddPcService;

/**
 * Pcを追加する
 *
 * Class AddPcController
 * @package Rental\Http\Controllers\Admin
 */
class AddPcController extends Controller
{
    public function form(AddPcService $service)
    {
        // Memo: validation エラーになったときは、
        //       画面に描画するデータあり

        $form_data = $service->getFormData();

        return view('rental.admin.device.add_pc')->with($form_data);
    }

    public function action(AddPcRequest $request, AddPcService $service)
    {
        $param = $request->all();
        //preDump($param,1);

        $service->registerData($param);

        exit('登録完了！！');
    }

    /*
    public function software_name()
    {
        $md = new PcSoftwareMasterData();
        $data = $md->getAll();
        return view('rental.admin.add_pc',['data'=>$data]);
    }
    */
}
