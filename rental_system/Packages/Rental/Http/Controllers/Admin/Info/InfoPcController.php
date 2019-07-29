<?php


namespace Rental\Http\Controllers\Admin\Info;

use App\Http\Controllers\Controller;
use Rental\Services\Admin\Info\InfoPcService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class InfoPcController extends Controller
{
    public function view(InfoPcService $service)
    {
        $param = \Request::all();
        $data = $service->getData($param);
        $filename = "/bootsample/img/device_image_{{$detail['rental_device_id']}}.jpg";

        return view('rental.admin.Device.info_pc')->with($data,$filename);
    }


}
