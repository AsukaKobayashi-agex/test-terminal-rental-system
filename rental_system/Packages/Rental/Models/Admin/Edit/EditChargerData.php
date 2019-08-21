<?php

namespace Rental\Models\Admin\Edit;

use Rental\Models\_common\AdminAccountData;



class EditChargerData
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

    public function getAllEditCharger($param)
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

    public function updateChargerData($param)
    {
        // トランザクション開始
        \DB::beginTransaction();
        try {
            $now = nowDatetime();
            //レンタル品情報の更新日を更新
            \DB::table('rental_device')->where('rental_device_id','=',$param['rental_device_id'])->update(['update_date'=>$now]);

            // 充電機テーブルにデータを登録する
            $charger_id = $this->_updateCharger($param);

            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return $charger_id;
    }

    protected function _updateCharger($param)
    {
        $charger_data = [
            'charger_name' => mb_convert_kana($param['charger_name'],'KVnr'),
            'charger_type' => $param['charger_type']
        ];
        return \DB::table('charger')->where('charger_id',$param['charger_id'])->update($charger_data);
    }
}
