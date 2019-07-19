<?php

namespace Rental\Models\_common;


class GetUserInfo
{
    public function getUserInfo($param){
        $bind_params=[
            'user_id' => \Arr::get($param, 'user_id', 0)
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

        $user_info = stdClassToArray(\DB::selectOne($sql, $bind_params));

        return $user_info;
    }
}
