<?php

namespace Rental\Models\Admin\Edit;

use Rental\Models\_common\PcSoftwareData;
use Rental\Models\_common\AdminAccountData;

error_reporting(0);
class EditPcData
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
            'device_name'=>mb_convert_kana($param['device_name'],'KVnr'),
            'os' => $param['os'],
            'os_version' => mb_convert_kana($param['os_version'],'KVnr')
        ];
        return \DB::table('test_device_basic')->where('test_device_id',$param['test_device_id'])->update($data);
    }

    protected function _updatePcData($param)
    {
        if(isset($param['device_img'])){
            $device_img = 1;
        }else{
            $device_img = 0;
        }
        if($device_img === 1) {
            $pc_data = [
                'pc_account_name' => mb_convert_kana($param['pc_account_name'], 'KVnr'),
                'mail_address' => mb_convert_kana($param['mail_address'], 'KVnr'),
                'device_img' => $device_img,
                'memo' => mb_convert_kana($param['memo'], 'KVnr'),
                'admin_memo' => mb_convert_kana($param['admin_memo'], 'KVnr')
            ];
        }

            if($device_img === 0) {
                $pc_data = [
                    'pc_account_name' => mb_convert_kana($param['pc_account_name'], 'KVnr'),
                    'mail_address' => mb_convert_kana($param['mail_address'], 'KVnr'),
                    'memo' => mb_convert_kana($param['memo'], 'KVnr'),
                    'admin_memo' => mb_convert_kana($param['admin_memo'], 'KVnr')
                ];
        }
        return \DB::table('test_device_pc')->where('test_device_id',$param['test_device_id'])->update($pc_data);
    }

    protected function _deletePcSoftware($param)
    {
        return \DB::table('pc_software')->where('test_device_id',$param['test_device_id'])->delete();
    }

    protected function _insertPcSoftware($param)
    {
        if (empty($param['software_id']) || !is_array($param['software_id'])) {
            return;
        }
        $test_device_id = $param['test_device_id'];
        $data = [
            'test_device_id'=>$param['test_device_id'],
            'software_id' =>$param['software_id']
        ];
        return $this->_pc_software_model->insertPcSoftware($test_device_id,$data);
    }
    
}
