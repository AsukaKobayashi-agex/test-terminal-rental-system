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
//         preDump($param);

        $service->registerData($param);

        //exit('データ登録完了！！');
        return redirect('/admin/index_pc')->with('success', 'PC情報を更新しました！');
    }
}
