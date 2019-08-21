<?php

namespace Rental\Models\_common;

class RentalDeviceData
{
    public function insertRentalDevice($data)
    {
        $now = nowDateTime();
        $insert_data = [
            'device_category' => $data['device_category'],
            'archive_flag' => $data['archive_flag'],
            'registration_date' => $now,
            'update_date' => $now
        ];

        $rental_device_id = \DB::table('rental_device')->insertGetId($insert_data);
        return $rental_device_id;
    }

}
