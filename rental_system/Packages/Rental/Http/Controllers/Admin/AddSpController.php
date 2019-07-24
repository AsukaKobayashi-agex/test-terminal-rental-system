<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\AddSpRequest;
use Rental\Services\Admin\AddSpService;

class AddSpController extends Controller
{
    public function form(AddSpService $service)
    {
        $form_data = $service->getFormData();
        return view('rental.admin.Device.add_sp')->with($form_data);
    }

    public function action(AddSpRequest $request, AddSpService $service)
    {
        $param = $request->all();
        //preDump($param,1);

        $rental_device_id = $service->registerData($param);

        if(isset($param['device_img'])) {
            $img_client = $request->file('device_img') -> getClientOriginalExtension();
            $request -> file('device_img')->move("bootsample/img","device_image_{$rental_device_id}.{$img_client}");

        }


        exit('登録完了！！');
    }
}

