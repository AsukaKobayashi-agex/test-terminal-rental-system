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
            $request -> file('device_img')->move("bootsample/img","device_image_{$rental_device_id}.jpg");
            $file = $_SERVER["DOCUMENT_ROOT"]."/bootsample/img/device_image_{$rental_device_id}.jpg";
            $imagick = new \Imagick($file);
            $format = strtolower($imagick->getImageFormat());

            if ($format === 'jpeg') {
                $orientation = $imagick->getImageOrientation();
                $isRotated = false;
                if ($orientation === \Imagick::ORIENTATION_RIGHTTOP) {
                    $imagick->rotateImage('none', 90);
                    $isRotated = true;
                } elseif ($orientation === \Imagick::ORIENTATION_BOTTOMRIGHT) {
                    $imagick->rotateImage('none', 180);
                    $isRotated = true;
                } elseif ($orientation === \Imagick::ORIENTATION_LEFTBOTTOM) {
                    $imagick->rotateImage('none', 270);
                    $isRotated = true;
                }
                if ($isRotated) {
                    $imagick->setImageOrientation(\Imagick::ORIENTATION_TOPLEFT);
                }
            }
            $imagick->adaptiveResizeImage(700, 0);
            $imagick->writeImage($file);
        }

        return redirect("/admin/info_pc?rental_device_id={$rental_device_id}")->with('success', 'PCを登録しました！');
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
