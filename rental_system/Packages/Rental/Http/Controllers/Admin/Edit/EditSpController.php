<?php

namespace Rental\Http\Controllers\Admin\Edit;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Edit\EditSpRequest;
use Rental\Services\Admin\Edit\EditSpService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class EditSpController extends Controller
{
    public function view(EditSpService $service)
    {
        $param = \Request::all();
        $data = $service->getData($param);
        return view('rental.admin.Device.edit_sp')->with($data);
    }

    public function action(EditSpRequest $request, EditSpService $service)
    {
        $param = $request->all();
        //preDump($param,1);

        $service->registerData($param);

        if(isset($param['device_img'])) {
            $img_client = $request->file('device_img') -> getClientOriginalExtension();
            $request -> file('device_img')->move("bootsample/img","device_image_{$param['rental_device_id']}.{$img_client}");

        }

        return redirect("/admin/info_sp?rental_device_id={$param['rental_device_id']}")->with('success', 'モバイル端末情報を更新しました！');
    }
}
