<?php

namespace Rental\Models\Admin;

use Rental\Models\_common\PcSoftwareData;
use Rental\Models\_common\RentalDeviceData;
use Rental\Models\_common\RentalStateData;
use Rental\Models\_common\TestDeviceBasicData;
use Rental\Models\_common\AdminAccountData;


class AddPcData
{
    protected $_rental_device_model;
    protected $_rental_state_model;
    protected $_test_device_basic_model;
    protected $_pc_software_model;
    protected $_get_admin_info;

    public function __construct(RentalDeviceData $rental_device,TestDeviceBasicData $test_device_basic,RentalStateData $rental_state,PcSoftwareData $pc_software,AdminAccountData $adminInfo)
    {
        $this->_rental_device_model = $rental_device;
        $this->_rental_state_model = $rental_state;
        $this->_test_device_basic_model = $test_device_basic;
        $this->_pc_software_model = $pc_software;
        $this->_get_admin_info = $adminInfo;

    }

    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }

    public function insertPcData($param)
    {
        \DB::beginTransaction();
        try {
            // レンタル品テーブルにデータを登録する
            $rental_device_id = $this->_insertRentalDevice();

            // レンタル状態テーブルにデータを登録する
            $this->_insertRentalState($rental_device_id);

            //テスト端末基本情報テーブルにデータを登録する
            $test_device_id = $this->_insertTestDeviceBasic($rental_device_id,$param);

            //テスト端末PC情報テーブルにデータを登録する
            $this->_insertPcData($test_device_id,$param);

            //PCソフトウェアテーブルにデータを登録する
            if(isset($param['software_id'])){
                $this->_pc_software_model->insertPcSoftware($test_device_id,$param);;

            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }

        return $rental_device_id;
    }

    protected function _insertRentalDevice()
    {
        $data = [
            'device_category' => 1,
            'archive_flag' => 0
        ];
        $rental_device_id = $this->_rental_device_model->insertRentalDevice($data);
        return $rental_device_id;
    }

    protected function _insertRentalState($rental_device_id)
    {
        return $this->_rental_state_model->insertRentalState($rental_device_id);
    }

    protected function _insertTestDeviceBasic($rental_device_id,$param)
    {
        $data = [
            'device_name'=>$param['device_name'],
            'test_device_category' => 2,
            'os' => $param['os'],
            'os_version' => $param['os_version']
        ];
        $test_device_id = $this->_test_device_basic_model->insertTestDeviceBasic($rental_device_id, $data,$param);
        return $test_device_id;
    }

    protected function _insertPcData($test_device_id,$param)
    {
        if(isset($param['device_img'])){
            $device_img = 1;
        }else{
            $device_img = 0;
        }
        $pc_data = [
            'test_device_id' => $test_device_id,
            'pc_account_name' => $param['pc_account_name'],
            'mail_address' => "{$param['mail_address']}",
            'device_img' => $device_img,
            'memo' => "{$param['memo']}",
            'admin_memo' => "{$param['admin_memo']}"
        ];
        return \DB::table('test_device_pc')->insert($pc_data);
    }

}
