<?php

namespace Rental\Models\Admin\Info;

use Rental\Models\_common\MobileInstalledAppData;
use Rental\Models\_common\AdminAccountData;


error_reporting(0);
class InfoSpData
{
    protected $_mobile_installed_app_model;
    protected $_get_admin_info;

    public function __construct(MobileInstalledAppData $mobile_installed_app,AdminAccountData $adminInfo)
    {
        $this->_mobile_installed_app_model = $mobile_installed_app;
        $this->_get_admin_info = $adminInfo;
    }


    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }


    public function getAllInfoSp($param)
    {
        // バインド値設定
        $bind_params = [
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
    mobile_app_id,
    name,
    rental_datetime,
    os,
    os_version,
    carrier_name,
    mobile_type,
    number,
    mail_address,
    wifi_line,
    communication_line,
    sim_card,
    charger_type,
    resolution,
    display_size,
    CAST(`launch_date` AS DATE) AS `launch_date`,
    device_img,
    memo,
    admin_memo

from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_mobile as tdm
    on tdb.test_device_id = tdm.test_device_id
left outer join mobile_installed_app as mia
    on tdb.test_device_id = mia.test_device_id
left outer join user
    on rs.user_id = user.user_id
left outer join mobile_carrier as mc
    on mc.carrier_id = tdm.carrier_id
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

    public function getAllInstalledApp($param)
    {
        // バインド値設定
        $bind_params = [
        ];

        $sql = <<< End_of_sql
select
    app_name,
    CAST(`add_date` AS DATE) AS `add_date`
from mobile_installed_app as mia
left outer join mobile_app_master as mam
    on mia.mobile_app_id = mam.mobile_app_id
left outer join test_device_basic as tdb
    on tdb.test_device_id = mia.test_device_id
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




    /*
    protected function _updateMobileInstalledApp($param)
    {
        $data = [
            'test_device_id'=>$param['test_device_id'],
            'software_id' =>$param['mobile_app_id']
        ];
        return \DB::table('mobile_installed_app')->where('test_device_id',$param['test_device_id'])->update($data);
    }
    */
}
