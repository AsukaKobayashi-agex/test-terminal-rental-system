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

    public function setArchiveFlag($rental_device_id)
    {
        $now = nowDateTime();
        $update_data = [
            'archive_flag' => 1,
            'update_date' => $now
        ];

        \DB::table('rental_device')->where("rental_device_id","=",$rental_device_id)->update($update_data);
    }

    public function unsetArchiveFlag($rental_device_id)
    {
        $now = nowDateTime();
        $update_data = [
            'archive_flag' => 0,
            'update_date' => $now
        ];

        \DB::table('rental_device')->where("rental_device_id","=",$rental_device_id)->update($update_data);
    }
}
