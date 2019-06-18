<?php

namespace Rental\Models\User;

class TopData
{
    public function getAllRentalDevice()
    {
        // バインド値設定
        $params = [
            'archive_flag' => 0
        ];

        $sql = <<< End_of_sql
select
    *
from rental_device
where
    archive_flag = :archive_flag

End_of_sql;

        return stdClassToArray(\DB::select($sql, $params));
    }
}
