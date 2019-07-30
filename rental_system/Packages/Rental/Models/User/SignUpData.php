<?php

namespace Rental\Models\User;

class SignUpData
{

    public function createAccount($param){
        $now = nowDateTime();
        $insert_data = [
            'name' => mb_convert_kana($param['username'],"KVnr"),
            'password' => $param['password'],
            'address' => $param['address'],
            'division_id' =>$param['division_id'],
            'group_id' =>$param['group_id'],
            'registration_date' => $now,
            'update_date' => $now
        ];

        \DB::table('user')->insertGetId($insert_data);

        return true;
    }

}
