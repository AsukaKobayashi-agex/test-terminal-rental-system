<?php

namespace Rental\Models\_common;


class RentalStateData
{
    public function insertRentalState($data)
    {
        $default_time = 1900/1/1;
        $insert_data = [
            'rental_device_id' =>$data['rental_device_id'],
            'user_id' =>0,
            'status' => 0,
            'rental_datetime' => $default_time,
            'scheduled_return_datetime' => $default_time,
        ];

        return \DB::table('rental_device')->insert($insert_data);

    }
}
