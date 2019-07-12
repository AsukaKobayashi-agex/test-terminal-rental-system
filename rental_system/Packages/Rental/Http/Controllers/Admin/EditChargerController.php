<?php

namespace Rental\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\Admin\EditChargerRequest;
use Rental\Services\Admin\EditChargerService;

class EditChargerController extends Controller
{
    public function form()
    {
        return view('rental.admin.edit_charger');
    }
}
