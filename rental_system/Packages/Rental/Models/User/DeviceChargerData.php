<?php

namespace Rental\Models\User;

class DeviceChargerData
{
    public function getAllDeviceCharger($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
            'device_category' => 2
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    ch.charger_id,
    charger_name,
    charger_type,
    status,
    rs.user_id,
    name,
    rental_datetime
from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag
    and device_category = :device_category

End_of_sql;

        if(isset($param['search_word']) and !empty($param['search_word'])) {
            $search_word=preg_replace("|　|"," ",$param['search_word']);
            $search_words = explode(" ",$search_word);
            $i=0;
            foreach($search_words as $word){
                $i ++;
                $bind_params["charger_name{$i}"] = "%".$word."%";
                $sql .= <<< Add_sql

and charger_name like :charger_name{$i}

Add_sql;
            }};

        if(isset($param['charger_type'])) {
            $bind_params['charger_type'] = $param['charger_type'];
            $sql .= <<< Add_sql

and charger_type = :charger_type

Add_sql;
        };


        if(isset($param['status'])) {
            $bind_params['status'] = $param['status'];
            $sql .= <<< Add_sql

and status like :status

Add_sql;
        };



        $sql .= "order by device_category,charger_name;";



        return stdClassToArray(\DB::select($sql, $bind_params));
    }
}