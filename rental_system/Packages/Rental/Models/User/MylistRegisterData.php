<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class MylistRegisterData
{
    public function getAllMylistRegister($param)
    {
        // バインド値設定
        $bind_params = [
            'user_id' => \Auth::guard('user')->id()
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
    public function getAllRegisterDevice($param)
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
    test_device_id,
    test_device_category,
    device_name,
    charger_name
from rental_device as rd
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

        $sql .= "order by device_category,test_device_category,device_name,charger_name;";

        return stdClassToArray(\DB::select($sql, $bind_params));
    }


    public function registerDevice($param)
    {
        \DB::beginTransaction();
        try {
            if (isset($param['mylist_id']) and $param['mylist_id']==="new"){
                // 新規マイリストを作成
                $data=[
                    'mylist_name' => $param['mylist_name'],
                    'user_id' => \Auth::guard('user')->id()
                ];
                $mylist_id = $this->createNewMylist($data);
                foreach ($param['rental_device_id'] as $device){
                    $insert_data = [
                        'mylist_id' => $mylist_id,
                        'rental_device_id' => $device
                    ];
                    \DB::table('mylist_device')->insert($insert_data);
                }
            }else{
                $mylist_id = $param['mylist_id'];
                foreach ($param['rental_device_id'] as $device){
                    \DB::insert(\DB::raw("INSERT IGNORE INTO mylist_device(mylist_id, rental_device_id) VALUES ({$mylist_id},{$device});"));
                }
            }
            $update_data = [
                'update_date' => nowDateTime(),
            ];
            \DB::table('mylist')->where('mylist_id', $mylist_id)->update($update_data);

            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return true;
    }

    public function createNewMylist($data)
    {
        $now = nowDateTime();
        $insert_data = [
            'mylist_name' => $data['mylist_name'],
            'user_id' => \Auth::guard('user')->id(),
            'registration_date' => $now,
            'update_date' => $now
        ];

        $rental_device_id = \DB::table('mylist')->insertGetId($insert_data);
        return $rental_device_id;
    }

}
