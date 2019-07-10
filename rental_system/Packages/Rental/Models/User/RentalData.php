<?php

namespace Rental\Models\User;


class RentalData
{

    public function getAllRentalDevice($param)
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
    user_id,
    test_device_id,
    test_device_category,
    device_name,
    charger_name
from rental_device as rd
left outer join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
where archive_flag = :archive_flag

End_of_sql;

        if(isset($param['rental_device_id'])) {
            $action_devices = implode(",",$param['rental_device_id']);
                $sql .= <<< Add_sql

    and rd.rental_device_id in ({$action_devices})

Add_sql;
        };

        $sql .= "order by status,device_category,test_device_category,device_name,charger_name;";

        return stdClassToArray(\DB::select($sql, $bind_params));
    }


    public function rentalDevice($param)
    {
        \DB::beginTransaction();
        try {
            foreach ($param['rental_device_id'] as $device){
                $now = nowDateTime();
                $data = [
                    'status'=> 1,
                    'user_id' => 1,
                    'rental_datetime' => $now,
                    'scheduled_return_datetime' => date("Y-m-d 23:59:59",strtotime($now)),
                ];
                \DB::table('rental_state')->where('rental_device_id', $device)->update($data);

                $this->createHistory($device,$data);
            }
            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return true;
    }

    public function createHistory($device,$data)
    {
        $now = nowDateTime();
        $insert_data = [
            'rental_device_id'=>$device,
            'user_id' => $data['user_id'],
            'action_type' => 1,
            'registration_datetime' => $now,
        ];

        \DB::table('rental_history')->insert($insert_data);
        return true;
    }

}
