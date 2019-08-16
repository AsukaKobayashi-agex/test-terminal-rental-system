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

        return redirect("/admin/info_sp?rental_device_id={$rental_device_id}")->with('success', 'モバイル端末を登録しました！');
    }
}

