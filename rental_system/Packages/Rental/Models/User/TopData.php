<?php

namespace Rental\Models\User;

class TopData
{
    public function getAllRentalDevice()
    {
        // バインド値設定
        $params = [
            'archive_flag' => 0
        ];

        $sql = <<< End_of_sql
select
    *
from test_device_basic
left outer join rental_device
on test_device_basic.rental_device_id = rental_device.rental_device_id
inner join rental_state
on test_device_basic.rental_device_id = rental_state.rental_device_id

End_of_sql;

        return stdClassToArray(\DB::select($sql, $params));
    }
}
