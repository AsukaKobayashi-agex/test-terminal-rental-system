<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\ReturnRequest;
use Rental\Services\User\ReturnService;


/**
 * ユーザー画面TOP
 *
 * Class ReturnController
 * @package Rental\Http\Controllers\User
 */
class ReturnController extends Controller
{
    public function view(ReturnRequest $request, ReturnService $service)
    {
        $param = $request->all();
        if(!isset($param['rental_device_id'])){
            return redirect('/');
        }
        $data = $service->getData($param);
        return view('rental.user.device_action.return')->with($data);
    }

    public function return(ReturnRequest $request, ReturnService $service)
    {
        $param = $request->all();
        $service->returnDevice($param);

        return redirect('/')->with('flash_message','返却を完了しました');
    }

}
