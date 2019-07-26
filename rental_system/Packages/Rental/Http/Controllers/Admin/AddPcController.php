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

        return view('rental.admin.Device.add_pc')->with($form_data);
    }

    public function action(AddPcRequest $request, AddPcService $service)
    {
        $param = $request->all();

        $rental_device_id = $service->registerData($param);

        if(isset($param['device_img'])) {
            $img_client = $request->file('device_img') -> getClientOriginalExtension();
            $request -> file('device_img')->move("bootsample/img","device_image_{$rental_device_id}.{$img_client}");

        }

        return redirect('/admin/index_pc')->with('success', 'PCを登録しました！');
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
