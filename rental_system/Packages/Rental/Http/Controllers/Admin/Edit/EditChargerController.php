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
    public function view(EditChargerRequest $request, EditChargerService $service)
    {
        $param = $request->all();
        $data = $service->getData($param);
        return view('rental.admin.Device.Edit_charger')->with($data);
    }
}
