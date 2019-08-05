<?php

namespace Rental\Models\_common;

class RentalHistoryData
{
    const TABLE_NAME = 'rental_history';


    public function getAll()
    {
        $data = stdClasstoarray(\DB::table(self::TABLE_NAME)->orderby('registration_datetime','DESC')->get());
        return $data;
    }

    public function getOne($rental_device_id)
    {
        $data = stdClasstoarray(
            \DB::table(self::TABLE_NAME)
            ->select('name','registration_datetime')
            ->leftjoin('user','rental_history.user_id','=','user.user_id')
            ->where('rental_device_id','=',$rental_device_id)
            ->where('action_type','=',1)
            ->orderby('registration_datetime','DESC')
            ->first()
        );
        return $data;
    }

}
