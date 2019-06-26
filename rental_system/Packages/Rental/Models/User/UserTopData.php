<?php

namespace Rental\Models\User;

class UserTopData
{
    public function getAllUserTop($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    test_device_id,
    device_name,
    charger_name,
    status,
    rs.user_id,
    name,
    rental_datetime
from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag

End_of_sql;

        if(isset($param['search_word']) and !empty($param['search_word'])) {
            $search_word=preg_replace("|　|"," ",$param['search_word']);
            $search_words = explode(" ",$search_word);
            $i=0;
        foreach($search_words as $word){
            $i ++;
            $bind_params["device_name{$i}"] = "%".$word."%";
            $bind_params["charger_name{$i}"] = "%".$word."%";
            $sql .= <<< Add_sql

and (device_name like :device_name{$i}
or charger_name like :charger_name{$i})

Add_sql;
        }};

        $sql .= "order by device_category,device_name,charger_name;";



        return stdClassToArray(\DB::select($sql, $bind_params));
    }
}
