<?php

namespace Rental\Models\Admin\Edit;

use Rental\Models\_common\GetUserInfo;
use Rental\Models\_common\MobileInstalledAppData;
use Rental\Models\_common\RentalDeviceData;
use Rental\Models\_common\RentalStateData;
use Rental\Models\_common\TestDeviceBasicData;


error_reporting(0);
class EditSpData
{
    protected $_get_user_info;
    protected $_mobile_installed_app_model;

    public function __construct(GetUserInfo $userInfo,MobileInstalledAppData $mobile_installed_app)
    {
        $this->_get_user_info = $userInfo;
        $this->_mobile_installed_app_model = $mobile_installed_app;
    }


    public function getUserInfo($param)
    {
        $param['user_id'] = 1;
        $user_info = $this->_get_user_info->getUserInfo($param);

        return $user_info;
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
            //テスト端末基本情報テーブルにデータを登録する
            $this->_updateTestDeviceBasic($param);

            //テスト端末モバイル情報テーブルにデータを登録する
            $this->_updateSpData($param);

            //インストール済みアプリテーブルのデータを削除する
            $this->_deleteMobileInstalledApp($param);

            //インストール済みアプリテーブルにデータを登録する
            $this->_insertMobileInstalledApp($param);



            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    protected function _updateTestDeviceBasic($param)
    {
        $data = [
            'device_name' => mb_convert_kana($param['device_name'],'KV'),
            'os' => $param['os'],
            'os_version' => mb_convert_kana($param['os_version'],'n')
        ];
        return \DB::table('test_device_basic')->where('test_device_id', $param['test_device_id'])->update($data);
    }

    protected function _updateSpData($param)
    {
        //Arr::get($param,'launch_date','1900/01/01');

        $sp_data = [
            'carrier_id' => $param['carrier_id'],
            'mobile_type' => $param['mobile_type'],
            'number' => mb_convert_kana($param['number'],'n'),
            'mail_address' => $param['mail_address'],
            'wifi_line' => $param['wifi_line'],
            'communication_line' => $param['communication_line'],
            'sim_card' => $param['sim_card'],
            'charger_type' => $param['charger_type'],
            'resolution' => mb_convert_kana($param['resolution'],'n'),
            'display_size' => mb_convert_kana($param['display_size'],'n'),
            'launch_date' => $param['launch_date'],
            'memo' => $param['memo'],
            'admin_memo' => $param['admin_memo']
        ];
        return \DB::table('test_device_mobile')->where('test_device_id', $param['test_device_id'])->update($sp_data);
    }

    protected function _deleteMobileInstalledApp($param)
    {
        return \DB::table('mobile_installed_app')->where('test_device_id', $param['test_device_id'])->delete();
    }

    protected function _insertMobileInstalledApp($param)
    {
        if (empty($param['mobile_app_id']) || !is_array($param['mobile_app_id'])) {
            return;
        }
        $data = [
            'test_device_id'=>$param['test_device_id'],
            'mobile_app_id' =>$param['mobile_app_id']
        ];
        return $this->_mobile_installed_app_model->insertMobileInstalledApp($data);
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
