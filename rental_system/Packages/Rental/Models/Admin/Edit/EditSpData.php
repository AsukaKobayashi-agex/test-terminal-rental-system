<?php

namespace Rental\Models\Admin\Edit;

use Rental\Models\_common\GetUserInfo;
use Rental\Models\_common\MobileInstalledAppData;
use Rental\Models\_common\AdminAccountData;


error_reporting(0);
class EditSpData
{
    protected $_get_user_info;
    protected $_mobile_installed_app_model;
    protected $_get_admin_info;

    public function __construct(GetUserInfo $userInfo,MobileInstalledAppData $mobile_installed_app,AdminAccountData $adminInfo)
    {
        $this->_mobile_installed_app_model = $mobile_installed_app;
        $this->_get_admin_info = $adminInfo;
    }


    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }


    public function getAllEditSp($param)
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
    mobile_app_id,
    name,
    rental_datetime,
    os,
    os_version,
    tdm.carrier_id,
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

    public function getAllInstalledApp($param)
    {
        // バインド値設定
        $bind_params = [
        ];

        $sql = <<< End_of_sql
select
    mia.mobile_app_id
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


        $data = stdClassToArray(\DB::select($sql, $bind_params));
        foreach ($data as $id){
            $mobile_app_id[] = $id['mobile_app_id'];
        }
        return $mobile_app_id;
    }


    public function updateSpData($param)
    {
        \DB::beginTransaction();
        try {
            $now = nowDatetime();
            //レンタル品情報の更新日を更新
            \DB::table('rental_device')->where('rental_device_id','=',$param['rental_device_id'])->update(['update_date'=>$now]);

            //テスト端末基本情報テーブルにデータを登録する
            $this->_updateTestDeviceBasic($param);

            //テスト端末モバイル情報テーブルにデータを登録する
            $this->_updateSpData($param);

            //インストール済みアプリテーブルのデータを更新する
            $this->updateMobileInstalledApp($param);



            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    protected function _updateTestDeviceBasic($param)
    {
        $data = [
            'device_name' => mb_convert_kana($param['device_name'],'KVnr'),
            'os' => $param['os'],
            'os_version' => mb_convert_kana($param['os_version'],'KVnr')
        ];
        return \DB::table('test_device_basic')->where('test_device_id', $param['test_device_id'])->update($data);
    }

    protected function _updateSpData($param)
    {
        if(isset($param['device_img'])){
            $device_img = 1;
        }else{
            $device_img = 0;
        }

        if($device_img === 1) {
            $sp_data = [
                'carrier_id' => $param['carrier_id'],
                'mobile_type' => $param['mobile_type'],
                'number' => mb_convert_kana($param['number'], 'KVnr'),
                'mail_address' => mb_convert_kana($param['mail_address'], 'KVnr'),
                'wifi_line' => $param['wifi_line'],
                'communication_line' => $param['communication_line'],
                'device_img' => $device_img,
                'sim_card' => $param['sim_card'],
                'charger_type' => $param['charger_type'],
                'resolution' => mb_convert_kana($param['resolution'], 'KVnr'),
                'display_size' => mb_convert_kana($param['display_size'], 'KVnr'),
                'launch_date' => $param['launch_date'],
                'memo' => mb_convert_kana($param['memo'], 'KVnr'),
                'admin_memo' => mb_convert_kana($param['admin_memo'], 'KVnr')
            ];
        }

        if($device_img === 0) {
            $sp_data = [
                'carrier_id' => $param['carrier_id'],
                'mobile_type' => $param['mobile_type'],
                'number' => mb_convert_kana($param['number'], 'KVnr'),
                'mail_address' => mb_convert_kana($param['mail_address'], 'KVnr'),
                'wifi_line' => $param['wifi_line'],
                'communication_line' => $param['communication_line'],
                'sim_card' => $param['sim_card'],
                'charger_type' => $param['charger_type'],
                'resolution' => mb_convert_kana($param['resolution'], 'KVnr'),
                'display_size' => mb_convert_kana($param['display_size'], 'KVnr'),
                'launch_date' => $param['launch_date'],
                'memo' => mb_convert_kana($param['memo'], 'KVnr'),
                'admin_memo' => mb_convert_kana($param['admin_memo'], 'KVnr')
            ];
        }
        return \DB::table('test_device_mobile')->where('test_device_id', $param['test_device_id'])->update($sp_data);
    }

    protected function updateMobileInstalledApp($param)
    {
        $mobile_app = $param['mobile_app_id'];
        $test_device_id = $param['test_device_id'];
        return $this->_mobile_installed_app_model->updateMobileInstalledApp($test_device_id,$mobile_app);
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
