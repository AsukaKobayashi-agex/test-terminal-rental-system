<?php

namespace Rental\Models\Admin\Index;

use Rental\Models\_common\AdminAccountData;


class IndexArchivedData
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

    public function getIndexArchived($param,$page_limit)
    {
        // バインド値設定
        $bind_params = [
            'archive_flag' => 1
        ];

        $sql = <<< End_of_sql
select
    rd.rental_device_id,
    device_category,
    archive_flag,
    tdb.test_device_id,
    test_device_category,
    mobile_type,
    device_name,
    charger_name
from rental_device as rd
left outer join test_device_basic as tdb
    on rd.rental_device_id = tdb.rental_device_id
left outer join test_device_mobile as tdm
    on tdb.test_device_id = tdm.test_device_id
left outer join charger as ch
    on rd.rental_device_id = ch.rental_device_id
where archive_flag = :archive_flag

End_of_sql;

        if(isset($param['search_word'])) {
            $search=preg_replace("|　|"," ",$param['search_word']);
            $search_word=mb_convert_kana($search,"KV","UTF-8");
            $search_words = explode(" ",$search_word);
            $i=0;
            foreach($search_words as $word){
                $i ++;
                $bind_params["device_name{$i}"] = "%".$word."%";
                $bind_params["charger_name{$i}"] = "%".$word."%";
                $sql .= <<< Add_sql

and (device_name collate utf8mb4_unicode_ci like :device_name{$i}
or charger_name collate utf8mb4_unicode_ci like :charger_name{$i})

Add_sql;
            }};

        if(isset($param['search_id'])) {
                $bind_params["rental_device_id"] =$param['search_id'];
                $sql .= <<< Add_sql

and rd.rental_device_id = :rental_device_id

Add_sql;
            };

        //並べ替え
        $sql .= "order by rental_device_id desc";

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
