<?php

namespace Rental\Models\User;

class DeviceMobileData
{
    public function getAllDeviceMobile($param)
    {
        // バインド値設定
        $params = [
            'archive_flag' => 0,
            'test_device_category' => 1,
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    tdb.test_device_id,
    device_name,
    test_device_category,
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
and test_device_category = :test_device_category

End_of_sql;

        if(isset($param['type'])) {
            $params['type'] = $param['type'];
            $sql .= <<< Add_sql

and mobile_type = :type

Add_sql;
        };
        if(isset($param['name']) and !empty($param['name'])) {
            $params['device_name'] = "%".preg_replace("/\s/","%",$param['name'])."%";
            $sql .= <<< Add_sql

and device_name like :device_name

Add_sql;
        };
        if(isset($param['os'])) {
            $params['os'] = $param['os'];
            $sql .= <<< Add_sql

and os = :os

Add_sql;
        };
        if(isset($param['com_line'])) {
            $params['com_line'] = $param['com_line'];
            $sql .= <<< Add_sql

and communication_line = :com_line

Add_sql;
        };
        if(isset($param['wifi'])) {
            $params['wifi'] = $param['wifi'];
            $sql .= <<< Add_sql

and wifi_line like :wifi

Add_sql;
        };
        if(isset($param['status'])) {
            $params['status'] = $param['status'];
            $sql .= <<< Add_sql

and status like :status

Add_sql;
        };

        $sql .= "order by device_category,device_name;";



        return stdClassToArray(\DB::select($sql, $params));
    }
}
