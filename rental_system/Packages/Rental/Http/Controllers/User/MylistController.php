<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\MylistRequest;
use Rental\Services\User\MylistService;


/**
 * ユーザー画面TOP
 *
 * Class MylistController
 * @package Rental\Http\Controllers\User
 */
class MylistController extends Controller
{
    public function mylist(MylistRequest $request, MylistService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.user.mylist.mylist')->with($data);
    }

    public function delete(MylistRequest $request, MylistService $service)
    {
        $param = $request->all();

        $service->deleteMylistDevice($param);

        return redirect('/mylist');
    }

    public function rename(MylistRequest $request, MylistService $service)
    {
        $param = $request->all();

        $service->renameMylist($param);

        return redirect('/mylist')->with('flash_message','マイリストの名前を変更しました');
    }

    public function delete_mylist(MylistRequest $request, MylistService $service)
    {
        $param = $request->all();

        $service->deleteMylist($param);

        return redirect('/mylist')->with('flash_message','マイリストを削除しました');
    }

}
