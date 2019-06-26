<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class Add_chargerController extends Controller
{
    public function view()
    {
        return view('rental.admin.add_charger');
    }
    public function create() {
        return view('rental.admin.action.charger');
    }

    public function store() {
        // ① フォームの入力値を取得
        $inputs = \Request::all();

        // ② デバッグ： $inputs の内容確認
        dd($inputs);
    }
}
