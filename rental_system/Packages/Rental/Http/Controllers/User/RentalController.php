<?php

namespace Rental\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Rental\Http\Requests\User\RentalRequest;
use Rental\Services\User\RentalService;


/**
 * ユーザー画面TOP
 *
 * Class RentalController
 * @package Rental\Http\Controllers\User
 */
class RentalController extends Controller
{
    public function view(RentalRequest $request, RentalService $service)
    {
        //$param = $request->old(null,[]);
        $param = $request->all();
        if(!isset($param['rental_device_id'])){
            return redirect('/');
        }
        //preDump($param,1);
        $data = $service->getData($param);
        //var_dump($data);
        return view('rental.user.action.rental')->with($data);
    }

    public function rental(RentalRequest $request, RentalService $service)
    {
        $param = $request->all();
        $service->rentalDevice($param);

        return redirect('/mylist');
    }

}
