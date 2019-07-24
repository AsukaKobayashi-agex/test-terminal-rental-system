<?php

namespace Rental\Models\Admin\Index;

use Rental\Models\_common\AdminAccountData;


class IndexSpData
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



    public function getAllIndexSp($param)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
            'test_device_category' => 1
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
    tdm.carrier_id,
    name,
    rental_datetime,
    mobile_type,
    wifi_line,
    communication_line,
    os,
    os_version,
    carrier_name
from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_mobile as tdm
    on tdb.test_device_id = tdm.test_device_id
left outer join user
    on rs.user_id = user.user_id
left outer join mobile_carrier as mc
    on tdm.carrier_id = mc.carrier_id
where archive_flag = :archive_flag
    and test_device_category = :test_device_category

End_of_sql;

        if(isset($param['search_id'])) {
            $bind_params["rental_device_id"] =$param['search_id'];
            $sql .= <<< Add_sql

and rd.rental_device_id = :rental_device_id

Add_sql;
        };

        if(isset($param['type'])) {
            $bind_params['type'] = $param['type'];
            $sql .= <<< Add_sql

and mobile_type = :type

Add_sql;
        };

        if(isset($param['search_word'])) {
            $search=preg_replace("|　|"," ",$param['search_word']);
            $search_word=mb_convert_kana($search,"KV","UTF-8");
            $search_words = explode(" ",$search_word);
            $i=0;
            foreach($search_words as $word){
                $i ++;
                $bind_params["device_name{$i}"] = "%".$word."%";
                $sql .= <<< Add_sql

and device_name collate utf8mb4_unicode_ci like :device_name{$i}

Add_sql;
            }};

        if(isset($param['os'])) {
            $bind_params['os'] = $param['os'];
            $sql .= <<< Add_sql

and os = :os

Add_sql;
        };

        if(isset($param['os_version'])) {
            $search_os_version=preg_replace("|　|"," ",$param['os_version']);
            $search_os_versions = explode(" ",$search_os_version);
            $i=0;
            foreach($search_os_versions as $word){
                $i ++;
                $bind_params["os_version{$i}"] = "%".$word."%";
                $sql .= <<< Add_sql

and os_version collate utf8mb4_unicode_ci like :os_version{$i}

Add_sql;
            }};

        if(isset($param['search_carrier'])) {
            $bind_params['carrier_id'] = $param['search_carrier'];
            $sql .= <<< Add_sql

and tdm.carrier_id = :carrier_id

Add_sql;
        };

        if(isset($param['status']) && strpos($param['status'], 'user') === false) {
            $bind_params['status'] = $param['status'];
            $sql .= <<< Add_sql

and status = :status

Add_sql;
        }elseif(isset($param['status']) && strpos($param['status'],'user') !== false){
            $bind_params['user_id'] = ltrim($param['status'],'user=');
            $sql .= <<< Add_sql

and rs.user_id = :user_id

Add_sql;
        };
        $sql .= "order by device_category,mobile_type,device_name;";



        return stdClassToArray(\DB::select($sql, $bind_params));
    }
}
