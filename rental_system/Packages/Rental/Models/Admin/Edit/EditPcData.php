<?php

namespace Rental\Models\Admin\Edit;

use Rental\Models\_common\GetUserInfo;
use Rental\Models\_common\PcSoftwareData;

error_reporting(0);
class EditPcData
{
    protected $_get_user_info;
    public function __construct(GetUserInfo $userInfo,PcSoftwareData $pc_software)
    {
        $this->_get_user_info = $userInfo;
        $this->_pc_software_model = $pc_software;
    }


    public function getUserInfo($param){
        $param['user_id'] = 1;
        $user_info = $this -> _get_user_info -> getUserInfo($param);

        return $user_info;
    }


    public function getAllEditPc($param)
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
    psm.software_id
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


        $data = stdClassToArray(\DB::select($sql, $bind_params));
        foreach ($data as $id){
            $software_id[] = $id['software_id'];
        }
        return $software_id;
    }

    public function getSoftwareId($param)
    {
    }

    protected $_pc_software_model;


    public function updatePcData($param)
    {
        \DB::beginTransaction();
        try {

            //テスト端末基本情報テーブルにデータを登録する
            $this->_updateTestDeviceBasic($param);

            //テスト端末PC情報テーブルにデータを登録する
            $this->_updatePcData($param);

            //PCソフトウェアテーブルのデータを削除する
            $this ->_deletePcSoftware($param);

            //PCソフトウェアテーブルにデータを登録する
            $this ->_insertPcSoftware($param);

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }


    protected function _updateTestDeviceBasic($param)
    {
        $data = [
            'device_name'=>mb_convert_kana($param['device_name'],'KV'),
            'os' => $param['os'],
            'os_version' => mb_convert_kana($param['os_version'],'n')
        ];
        return \DB::table('test_device_basic')->where('test_device_id',$param['test_device_id'])->update($data);
    }

    protected function _updatePcData($param)
    {
        $pc_data = [
            'pc_account_name' => $param['pc_account_name'],
            'mail_address' => $param['mail_address'],
            'memo' => $param['memo'],
            'admin_memo' => $param['admin_memo']
        ];
        return \DB::table('test_device_pc')->where('test_device_id',$param['test_device_id'])->update($pc_data);
    }

    protected function _deletePcSoftware($param)
    {
        return \DB::table('pc_software')->where('test_device_id',$param['test_device_id'])->delete();
    }

    protected function _insertPcSoftware($param)
    {
//        preDump($param,1);
        if (empty($param['software_id']) || !is_array($param['software_id'])) {
            return;
        }
        $data = [
            'test_device_id'=>$param['test_device_id'],
            'software_id' =>$param['software_id']
        ];
        return $this->_pc_software_model->insertPcSoftware($data);
    }
    
}
