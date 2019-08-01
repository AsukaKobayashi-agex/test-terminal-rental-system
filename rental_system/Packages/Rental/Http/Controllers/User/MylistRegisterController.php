<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\MylistRegisterRequest;
use Rental\Services\User\MylistRegisterService;


/**
 * ユーザー画面TOP
 *
 * Class MylistRegisterController
 * @package Rental\Http\Controllers\User
 */
class MylistRegisterController extends Controller
{
    public function mylist_register(MylistRegisterRequest $request, MylistRegisterService $service)
    {
        $param = $request->old(null,[]);
        $param += $request->all();
        if(!isset($param['rental_device_id'])){
            return redirect('/');
        }
        $data = $service->getData($param);
        return view('rental.user.mylist.mylist_register')->with($data);
    }

    public function register(MylistRegisterRequest $request, MylistRegisterService $service)
    {
        $param = $request->all();
        $service->registerDevice($param);

        return redirect('/mylist')->with('flash_message','マイリストの登録を完了しました');
    }

}
