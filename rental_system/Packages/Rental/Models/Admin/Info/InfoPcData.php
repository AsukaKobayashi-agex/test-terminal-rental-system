<?php

namespace Rental\Models\Admin\Info;

use Rental\Models\_common\PcSoftwareData;
use Rental\Models\_common\AdminAccountData;

error_reporting(0);
class InfoPcData
{
    protected $_get_admin_info;
    public function __construct(PcSoftwareData $pc_software,AdminAccountData $adminInfo)
    {
        $this->_pc_software_model = $pc_software;
        $this->_get_admin_info = $adminInfo;
    }

    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }


    public function getAllInfoPc($param)
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
    tdb.test_device_id,
    device_name,
    test_device_category,
    status,
    rs.user_id,
    software_id,
    name,
    rental_datetime,
    os,
    os_version,
    pc_account_name,
    mail_address,
    device_img,
    memo,
    admin_memo

from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_pc as tdp
    on tdb.test_device_id = tdp.test_device_id
left outer join pc_software as ps
    on tdb.test_device_id = ps.test_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag

End_of_sql;

        if (isset($param['rental_device_id']) and !empty($param['rental_device_id'])) {
            $bind_params['rental_device_id'] = $param['rental_device_id'];
            $sql .= <<< Add_sql

        and rd.rental_device_id = :rental_device_id

Add_sql;
        };


        $sql .= ";";


        $detail = stdClassToArray(\DB::select($sql, $bind_params));

        return $detail[0];
    }

    public function getAllInstalledSoftware($param)
    {
        // バインド値設定
        $bind_params = [
        ];

        $sql = <<< End_of_sql
select
    software_name,
    CAST(`software_add_date` AS DATE) AS `add_date`
from pc_software as ps
left outer join pc_software_master as psm
    on psm.software_id = ps.software_id
left outer join test_device_basic as tdb
    on tdb.test_device_id = ps.test_device_id
where

End_of_sql;

        if (isset($param['rental_device_id']) and !empty($param['rental_device_id'])) {
            $bind_params['rental_device_id'] = $param['rental_device_id'];
            $sql .= <<< Add_sql

        tdb.rental_device_id = :rental_device_id

Add_sql;
        };


        $sql .= ";";


        return stdClassToArray(\DB::select($sql, $bind_params));
    }

    public function getSoftwareId($param)
    {
    }

    protected $_pc_software_model;



}
