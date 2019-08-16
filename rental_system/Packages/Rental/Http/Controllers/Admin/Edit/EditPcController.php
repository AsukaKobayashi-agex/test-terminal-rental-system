<?php


namespace Rental\Http\Controllers\Admin\Edit;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Edit\EditPcRequest;
use Rental\Services\Admin\Edit\EditPcService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class EditPcController extends Controller
{
    public function view(EditPcService $service)
    {
        $param = \Request::all();
        $data = $service->getData($param);

        return view('rental.admin.Device.edit_pc')->with($data);
    }

    public function action(EditPcRequest $request, EditPcService $service)
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
            $imagick->adaptiveResizeImage(700, 0);
            $imagick->writeImage($file);
        }

        return redirect("/admin/info_pc?rental_device_id={$param['rental_device_id']}")->with('success', 'PC情報を更新しました！');
    }
}
