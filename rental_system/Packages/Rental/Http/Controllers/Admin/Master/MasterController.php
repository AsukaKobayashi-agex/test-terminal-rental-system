<?php

namespace Rental\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\Master\MasterRequest;
use Rental\Services\Admin\Master\MasterService;

/**
 * 充電機を追加する
 *
 * Class AddChargerController
 * @package Rental\Http\Controllers\Admin
 */
class MasterController extends Controller
{
    public function view(MasterService $service)
    {
        $data = $service->getData();
        //preDump($data,1);
        // Memo: validation エラーになったときは、
        //       画面に描画するデータあり
        return view('rental.admin.master.master')->with($data);
    }

    public function delete_app(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->delete_app($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','アプリを削除しました');
    }

    public function add_app(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->add_app($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','アプリを追加しました');
    }
    
    public function rename_app(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->rename_app($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','アプリ名を変更しました');
    }
    
    public function delete_software(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->delete_software($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','ソフトウェアを削除しました');
    }

    public function add_software(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->add_software($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','ソフトウェアを追加しました');
    }
    
    public function rename_software(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->rename_software($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','ソフトウェア名を変更しました');
    }
    
    public function delete_carrier(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->delete_carrier($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','キャリアを削除しました');
    }

    public function add_carrier(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->add_carrier($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','キャリアを追加しました');
    }
    
    public function rename_carrier(MasterService $service,MasterRequest $request)
    {
        $param = $request->all();
        $service->rename_carrier($param);

        // todo: デバイス一覧へリダイレクト
        return redirect('/admin/master')->with('flash_message','キャリア名を変更しました');
    }
}
