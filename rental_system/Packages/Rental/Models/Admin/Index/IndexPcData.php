<?php

namespace Rental\Models\Admin\Index;

use Rental\Models\_common\AdminAccountData;


class IndexPcData
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



    const TABLE_NAME = 'test_device_pc';

    public function getAllIndexPc($param,$page_limit)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 0,
            'test_device_category' => 2
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
    os,
    os_version,
    pc_account_name
from rental_device as rd
inner join rental_state as rs
    on rd.rental_device_id = rs.rental_device_id
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_pc as tdp
    on tdb.test_device_id = tdp.test_device_id
left outer join user
    on rs.user_id = user.user_id
where archive_flag = :archive_flag
    and test_device_category = :test_device_category

End_of_sql;

        if(isset($param['search_id'])) {
            $bind_params["rental_device_id"] =$param['search_id'];
            $sql .= <<< Add_sql

and rd.rental_device_id = :rental_device_id

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

        if(isset($param['search_account'])) {
            $search=preg_replace("|　|"," ",$param['search_account']);
            $search_account=mb_convert_kana($search,"KV","UTF-8");
            $search_accounts = explode(" ",$search_account);
            $i=0;
            foreach($search_accounts as $account){
                $i ++;
                $bind_params["pc_account_name{$i}"] = "%".$account."%";
                $sql .= <<< Add_sql

and pc_account_name collate utf8mb4_unicode_ci like :pc_account_name{$i}

Add_sql;
            }};

$sql .= "order by device_category,device_name";

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
