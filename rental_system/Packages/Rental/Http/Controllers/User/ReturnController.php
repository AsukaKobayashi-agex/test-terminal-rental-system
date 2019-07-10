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
        //$param = $request->old(null,[]);
        $param = $request->all();
        if(!isset($param['rental_device_id'])){
            return redirect('/');
        }
        //preDump($param,1);
        $data = $service->getData($param);
        //var_dump($data);
        return view('rental.user.device_action.return')->with($data);
    }

    public function return(ReturnRequest $request, ReturnService $service)
    {
        $param = $request->all();
        $service->returnDevice($param);

        return redirect('/mylist');
    }

}
