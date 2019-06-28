<?php

namespace Rental\Models\User;

class DevicePcData
{
    public function getAllDevicePc($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
            'test_device_category' => 2
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
    os,
    os_version
from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_pc as tdp
    on tdb.test_device_id = tdp.test_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag
    and test_device_category = :test_device_category

End_of_sql;

        if(isset($param['search_word']) and !empty($param['search_word'])) {
            $search_word=preg_replace("|　|"," ",$param['search_word']);
            $search_words = explode(" ",$search_word);
            $i=0;
            foreach($search_words as $word){
                $i ++;
                $bind_params["device_name{$i}"] = "%".$word."%";
                $sql .= <<< Add_sql

and device_name like :device_name{$i}

Add_sql;
            }};

        if(isset($param['os'])) {
            $bind_params['os'] = $param['os'];
            $sql .= <<< Add_sql

and os = :os

Add_sql;
        };

        if(isset($param['os_version']) and !empty($param['os_version'])) {
            $search_os_version=preg_replace("|　|"," ",$param['os_version']);
            $search_os_versions = explode(" ",$search_os_version);
            $i=0;
            foreach($search_os_versions as $word){
                $i ++;
                $bind_params["os_version{$i}"] = "%".$word."%";
                preDump($bind_params);
                $sql .= <<< Add_sql

and os_version like :os_version{$i}

Add_sql;
        }};

        if(isset($param['status'])) {
            $bind_params['status'] = $param['status'];
            $sql .= <<< Add_sql

and status like :status

Add_sql;
        };



        $sql .= "order by device_category,device_name;";



        return stdClassToArray(\DB::select($sql, $bind_params));
    }
}
