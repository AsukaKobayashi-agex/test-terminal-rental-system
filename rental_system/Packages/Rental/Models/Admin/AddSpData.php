<?php

namespace Rental\Models\Admin;

use Rental\Models\_common\RentalDeviceData;
use Rental\Models\_common\RentalStateData;
use Rental\Models\_common\TestDeviceBasicData;
use Rental\Models\_common\MobileInstalledAppData;
use Rental\Models\_common\AdminAccountData;


class AddSpData
{
    protected $_rental_device_model;
    protected $_rental_state_model;
    protected $_test_device_basic_model;
    protected $_mobile_installed_app_model;
    protected $_get_admin_info;


    public function __construct(RentalDeviceData $rental_device,TestDeviceBasicData $test_device_basic,RentalStateData $rental_state,MobileInstalledAppData $mobile_installed_app,AdminAccountData $adminInfo)
    {
        $this->_rental_device_model = $rental_device;
        $this->_rental_state_model = $rental_state;
        $this->_test_device_basic_model = $test_device_basic;
        $this->_mobile_installed_app_model = $mobile_installed_app;
        $this->_get_admin_info = $adminInfo;

    }

    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }


    public function insertSpData($param)
    {
        \DB::beginTransaction();
        try {
            // レンタル品テーブルにデータを登録する
            $rental_device_id = $this->_insertRentalDevice();

            // レンタル状態テーブルにデータを登録する
            $this->_insertRentalState($rental_device_id);

            //テスト端末基本情報テーブルにデータを登録する
            $test_device_id = $this->_insertTestDeviceBasic($rental_device_id,$param);

            //テスト端末モバイル情報テーブルにデータを登録する
            $this->_insertSpData($test_device_id,$param);

            //インストール済みアプリテーブルにデータを登録する
            if (isset($param['mobile_app_id'])) {
                $this->_mobile_installed_app_model->insertMobileInstalledApp($test_device_id,$param);
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
            'device_name'=>mb_convert_kana($param['device_name'],'KVnr'),
            'test_device_category' => 1,
            'os' => $param['os'],
            'os_version' => mb_convert_kana($param['os_version'],'KVnr')
        ];
        $test_device_id = $this->_test_device_basic_model->insertTestDeviceBasic($rental_device_id, $data);
        return $test_device_id;
    }

    protected function _insertSpData($test_device_id,$param)
    {
        if(isset($param['device_img'])){
            $device_img = 1;
        }else{
            $device_img = 0;
        }

        $sp_data = [
            'test_device_id' => $test_device_id,
            'carrier_id' => $param['carrier_id'],
            'mobile_type' => $param['mobile_type'],
            'number' => mb_convert_kana($param['number'],'KVnr'),
            'mail_address' => mb_convert_kana($param['mail_address'],'KVnr'),
            'wifi_line' => $param['wifi_line'],
            'communication_line' => $param['communication_line'],
            'device_img' => $device_img,
            'launch_date' => isset($param['launch_date']) ? $param['launch_date']:"1900/1/1",
            'sim_card' => $param['sim_card'],
            'charger_type' => $param['charger_type'],
            'resolution' => mb_convert_kana($param['resolution'],'KVnr'),
            'display_size' => mb_convert_kana($param['display_size'],'KVnr'),
            'memo' => mb_convert_kana($param['memo'],'KVnr'),
            'admin_memo' => mb_convert_kana($param['admin_memo'],'KVnr')
        ];
        //preDump($sp_data,1);
        return \DB::table('test_device_mobile')->insert($sp_data);
    }
}
