<?php

namespace Rental\Models\Admin\Info;

use Rental\Models\_common\AdminAccountData;



class InfoChargerData
{
    protected $_get_admin_info;
    public function __construct(AdminAccountData $adminInfo)
    {
        $this->_get_admin_info = $adminInfo;
    }

    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }

    public function getAllInfoCharger($param)
    {
        // バインド値設定
        $bind_params = [
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    status,
    rs.user_id,
    charger_id,
    name,
    rental_datetime,
    charger_name,
    charger_type

from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
left outer join user
    on rs.user_id = user.user_id
where

End_of_sql;

        if (isset($param['rental_device_id']) and !empty($param['rental_device_id'])) {
            $bind_params['rental_device_id'] = $param['rental_device_id'];
            $sql .= <<< Add_sql

        rd.rental_device_id = :rental_device_id

Add_sql;
        };


        $sql .= ";";


        $detail = stdClassToArray(\DB::select($sql, $bind_params));

        return $detail[0];
    }

}
