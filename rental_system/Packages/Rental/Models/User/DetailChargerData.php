<?php

namespace Rental\Models\User;

class DetailChargerData
{
    public function getAllDetailCharger($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    status,
    rs.user_id,
    name,
    rental_datetime,
    charger_name,
    charger_type

from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag

End_of_sql;

        if (isset($param['rental_device_id']) and !empty($param['rental_device_id'])) {
            $bind_params['rental_device_id'] = $param['rental_device_id'];
            $sql .= <<< Add_sql

        and rd.rental_device_id = :rental_device_id

Add_sql;
        };


        $sql .= ";";


        return stdClassToArray(\DB::select($sql, $bind_params));
    }

}
