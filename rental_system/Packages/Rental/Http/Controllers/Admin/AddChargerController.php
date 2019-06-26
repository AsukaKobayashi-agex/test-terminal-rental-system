<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\AddChargerRequest;
use Rental\Services\Admin\AddChargerService;

/**
 * 充電機を追加する
 *
 * Class AddChargerController
 * @package Rental\Http\Controllers\Admin
 */
class AddChargerController extends Controller
{
    public function form()
    {
        // Memo: validation エラーになったときは、
        //       画面に描画するデータあり
        return view('rental.admin.add_charger');
    }

    public function action(AddChargerRequest $request, AddChargerService $service)
    {
        $param = $request->all();
        // preDump($param, 1);

        $service->registerData($param);

        // todo: デバイス一覧へリダイレクト
        exit('データ登録完了！！');
    }
}
