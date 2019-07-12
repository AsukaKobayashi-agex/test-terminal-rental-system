<?php

namespace Rental\Models\User;

class MylistData
{
    public function getAllMylist($param)
    {
        // バインド値設定
        $bind_params = [
            'user_id' => 1
        ];

        $sql = <<< End_of_sql
select
    mylist_id,
    mylist_name,
    update_date
from mylist as ml
where user_id = :user_id

End_of_sql;


        $sql .= "order by update_date DESC;";



        return stdClassToArray(\DB::select($sql, $bind_params));
    }
    public function getAllMylistDevice($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
            'user_id' => 1
        ];

        $sql = <<< End_of_sql
select
    mld.mylist_id,
    rd.rental_device_id,
    device_category,
    archive_flag,
    test_device_id,
    test_device_category,
    device_name,
    charger_name,
    status,
    rs.user_id,
    name,
    rental_datetime
from mylist_device as mld
left outer join mylist as ml
    on mld.mylist_id = ml.mylist_id
left outer join rental_device as rd
    on mld.rental_device_id = rd.rental_device_id
left outer join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag
    and ml.user_id = :user_id

End_of_sql;


        $sql .= "order by device_category,test_device_category,device_name,charger_name;";



        return stdClassToArray(\DB::select($sql, $bind_params));
    }


    public function deleteMylistDevice($param)
    {
        $delete_data = [
            'mylist_id' => $param['delete_mylist_id'],
            'rental_device_id' => $param['delete_device_id']
        ];
        \DB::table('mylist_device')->where($delete_data)->delete();
        $update_data = [
            'update_date' => nowDateTime(),
        ];
        \DB::table('mylist')->where('mylist_id', $param['delete_mylist_id'])->update($update_data);
        return true;
    }

    public function renameMylist($param)
    {
        $update_data = [
            'update_date' => nowDateTime(),
            'mylist_name' => $param['mylist_name']
        ];
        \DB::table('mylist')->where('mylist_id', $param['mylist_id'])->update($update_data);
        return true;
    }

    public function deleteMylist($param)
    {
        \DB::table('mylist')->where('mylist_id', $param['mylist_id'])->delete();
        \DB::table('mylist_device')->where('mylist_id', $param['mylist_id'])->delete();
        return true;
    }

}
