<?php

namespace Rental\Models\User;

use Rental\Models\_common\GetUserInfo;


class DeviceMobileData
{
    public function getAllDeviceMobile($param,$page_limit)
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
    name,
    rental_datetime,
    mobile_type,
    wifi_line,
    communication_line,
    os,
    os_version
from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_mobile as tdm
    on tdb.test_device_id = tdm.test_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag
    and test_device_category = :test_device_category

End_of_sql;

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


        if(isset($param['com_line'])) {
            $bind_params['com_line'] = $param['com_line'];
            $sql .= <<< Add_sql

and communication_line = :com_line

Add_sql;
        };

        if(isset($param['wifi'])) {
            $bind_params['wifi'] = $param['wifi'];
            $sql .= <<< Add_sql

and wifi_line = :wifi

Add_sql;
        };

        if(isset($param['status']) && strpos($param['status'], 'user') === false) {
            $bind_params['status'] = $param['status'];
            $sql .= <<< Add_sql

and status = :status

Add_sql;
        }elseif(isset($param['status']) && strpos($param['status'],'user') !== false){
            $bind_params['user_id'] = ltrim($param['status'],'user=');
            $bind_params['status'] = 1;
            $sql .= <<< Add_sql

and rs.user_id = :user_id
and status = :status

Add_sql;
        };
        $sql .= "order by device_category,mobile_type,device_name";


        if($page_limit!==0){
            if (isset($param['page'])) {
                $nowPage = (int)$param['page'];
            } else {
                $nowPage = 1;
            }

            if ($nowPage > 1) {
                $start = ($nowPage - 1) * $page_limit;
            } else {
                $start = 0;
            }

            $sql .= " LIMIT {$start},$page_limit";
        }


        $sql .= ";";




        return stdClassToArray(\DB::select($sql, $bind_params));
    }
}
