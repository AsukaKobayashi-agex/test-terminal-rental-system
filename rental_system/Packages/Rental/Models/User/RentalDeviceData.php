<?php

namespace Rental\Models\User;

class RentalDeviceData
{
    public function getAllRentalDevice($param)
    {
        // バインド値設定
        $params = [
            'archive_flag' => 0,
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    test_device_id,
    device_name,
    status,
    rs.user_id,
    name,
    rental_datetime
from rental_device as rd
inner join rental_state as rs
on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
on rd.rental_device_id = tdb.rental_device_id
left outer join user
on rs.user_id = user.user_id
where archive_flag = :archive_flag

End_of_sql;

        if(isset($param['name']) and !empty($param['name'])) {
            $params['device_name'] = "%".$param['name']."%";
            $sql .= <<< Add_sql

and device_name like :device_name

Add_sql;
        };

        $sql .= ";";



        return stdClassToArray(\DB::select($sql, $params));
    }
}
