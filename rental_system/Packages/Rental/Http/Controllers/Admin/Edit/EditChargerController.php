<?php

namespace Rental\Http\Controllers\Admin\Edit;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Edit\EditChargerRequest;
use Rental\Services\Admin\Edit\EditChargerService;

/**
 * ユーザー画面TOP
 *
 * Class UserTopController
 * @package Rental\Http\Controllers\User
 */
class EditChargerController extends Controller
{
    public function view(EditChargerService $service)
    {
        $param = \Request::all();
        $data = $service->getData($param);
        return view('rental.admin.Device.edit_charger')->with($data);
    }

    public function action(EditChargerRequest $request, EditChargerService $service)
    {
        $param = $request->all();
        // preDump($param, 1);

        $service->registerData($param);

        // todo: デバイス一覧へリダイレクト
        //exit('データ登録完了！！');
        return redirect('/admin/index_charger')->with('success','充電器情報を更新しました！');
    }
}
