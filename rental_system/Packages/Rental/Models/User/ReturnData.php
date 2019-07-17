<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class ReturnData
{
    protected $_get_user_info;
    public function __construct(GetUserInfo $userInfo)
    {
        $this->_get_user_info = $userInfo;
    }


    public function getUserInfo($param){
        $param['user_id'] = 1;
        $user_info = $this -> _get_user_info -> getUserInfo($param);

        return $user_info;
    }


    public function getAllReturnDevice($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
            'user_id' => 1,
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

        $sql .= "order by status DESC,user_id=:user_id DESC,device_category,test_device_category,device_name,charger_name;";

        return stdClassToArray(\DB::select($sql, $bind_params));
    }


    public function returnDevice($param)
    {
        \DB::beginTransaction();
        try {
            foreach ($param['rental_device_id'] as $device){
                $defaultDateTime = defaultDateTime();
                $data = [
                    'status'=> 0,
                    'user_id' => 0,
                    'rental_datetime' => $defaultDateTime,
                    'scheduled_return_datetime' => $defaultDateTime,
                ];
                $where = [
                    'status'=> 1,
                    'rental_device_id'=> $device
                ];
                \DB::table('rental_state')->where($where)->update($data);

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
            'action_type' => 2,
            'registration_datetime' => $now,
        ];

        \DB::table('rental_history')->insert($insert_data);
        return true;
    }

}
