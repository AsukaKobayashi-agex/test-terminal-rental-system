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

        $service->registerData($param);

        if(isset($param['device_img'])) {
            $request -> file('device_img')->move("bootsample/img","device_image_{$param['rental_device_id']}.jpg");
            $file = $_SERVER["DOCUMENT_ROOT"]."/bootsample/img/device_image_{$param['rental_device_id']}.jpg";
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
            $imagick->writeImage($file);

        }

        return redirect("/admin/info_sp?rental_device_id={$param['rental_device_id']}")->with('success', 'モバイル端末情報を更新しました！');
    }
}
