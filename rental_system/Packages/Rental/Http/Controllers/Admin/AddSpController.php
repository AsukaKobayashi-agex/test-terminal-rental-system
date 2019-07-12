<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\AddSpRequest;
use Rental\Services\Admin\AddSpService;

class AddSpController extends Controller
{
    public function form(AddSpService $service)
    {
        $form_data = $service->getFormData();
        return view('rental.admin.add_sp')->with($form_data);
    }

    public function action(AddSpRequest $request, AddSpService $service)
    {
        $param = $request->all();
        //preDump($param,1);

        $service->registerData($param);

        exit('登録完了！！');
    }
}

