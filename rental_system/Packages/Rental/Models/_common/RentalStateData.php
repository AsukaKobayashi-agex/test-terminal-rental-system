<?php

namespace Rental\Models\_common;

use Rental\Models\_common\RentalDeviceData;
use Rental\Models\_common\UserData;


class RentalStateData
{
    public function insertRentalState($data)
    {
        $default_time = 1900/1/1;
        $insert_data = [
            'status' => $data['status'],
            'rental_datetime' => $default_time,
            'scheduled_return_datetime' => $default_time,
        ];

        $rental_device_id = \DB::table('rental_device')->insertGetId($insert_data);
        return $rental_device_id;

        $user_id = \DB::table('user')->insertGetId($insert_data);
        return $user_id;

    }
}
