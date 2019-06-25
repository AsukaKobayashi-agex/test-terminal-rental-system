<?php

namespace Rental\Models\User;

class DeviceSpData
{
    public function getAllDeviceSp($param)
    {
        // バインド値設定
        $params = [
            'archive_flag' => 0,
            'mobile_type' => 1,
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    tdb.test_device_id,
    device_name,
    status,
    rs.user_id,
    name,
    rental_datetime,
    mobile_type,
    wifi_line,
    communication_line,
    os,
    os_version
from rental_device as rd
inner join rental_state as rs
on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_mobile as tdm
on tdb.test_device_id = tdm.test_device_id
left outer join user
on rs.user_id = user.user_id
where archive_flag = :archive_flag
and mobile_type = :mobile_type

End_of_sql;

        if(isset($param['name']) and !empty($param['name'])) {
            $params['device_name'] = "%".preg_replace("/\s/","%",$param['name'])."%";
            $sql .= <<< Add_sql

and device_name like :device_name

Add_sql;
        };

        $sql .= "order by device_category,device_name;";



        return stdClassToArray(\DB::select($sql, $params));
    }
}
