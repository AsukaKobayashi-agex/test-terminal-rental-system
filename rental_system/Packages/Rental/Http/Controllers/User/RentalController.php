<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\RentalRequest;
use Rental\Services\User\RentalService;


/**
 * ユーザー画面TOP
 *
 * Class RentalController
 * @package Rental\Http\Controllers\User
 */
class RentalController extends Controller
{
    public function view(RentalRequest $request, RentalService $service)
    {
        $param = $request->all();
        if(!isset($param['rental_device_id'])){
            return redirect('/');
        }
        $data = $service->getData($param);
        return view('rental.user.device_action.rental')->with($data);
    }

    public function rental(RentalRequest $request, RentalService $service)
    {
        $param = $request->all();
        $message = $service->rentalDevice($param);

        if($message['error']){
            $error = "{$message['error']}台の貸出に失敗しました";
        }else{
            $error = "";
        }
        if($message['success']){
            $success = "{$message['success']}台の貸出を完了しました";
        }else{
            $success = "";
        }

        return redirect('/')->with('flash_message',$success)->with("error_message",$error);
    }

}
