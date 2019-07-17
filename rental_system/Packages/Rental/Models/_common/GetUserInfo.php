<?php

namespace Rental\Models\_common;


class GetUserInfo
{
    public function getUserInfo($param){
        $bind_params=[
            'user_id' => $param['user_id']
        ];

        $sql = <<< End_of_sql
select
    user_id,
    name,
    division_id,
    group_id,
    address
from user
where user_id = :user_id;

End_of_sql;

        $user_info = stdClassToArray(\DB::select($sql, $bind_params));

        return $user_info[0];
    }
}
