<?php

namespace Rental\Models\Admin;

use Rental\Models\_common\RentalDeviceData;
use Rental\Models\_common\RentalStateData;
use Rental\Models\_common\TestDeviceBasicData;
use Rental\Models\_common\MobileInstalledAppData;

class AddSpData
{
    protected $_rental_device_model;
    protected $_rental_state_model;
    protected $_test_device_basic_model;
    protected $_mobile_installed_app_model;

    public function __construct(RentalDeviceData $rental_device,TestDeviceBasicData $test_device_basic,RentalStateData $rental_state,MobileInstalledAppData $mobile_installed_app)
    {
        $this->_rental_device_model = $rental_device;
        $this->_rental_state_model = $rental_state;
        $this->_test_device_basic_model = $test_device_basic;
        $this->_mobile_installed_app_model = $mobile_installed_app;
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
            $this->_insertMobileInstalledApp($test_device_id,$param);


            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
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
            'test_device_category' => 1,
            'os' => $param['os']
        ];
        $test_device_id = $this->_test_device_basic_model->insertTestDeviceBasic($rental_device_id, $data,$param);
        return $test_device_id;
    }

    protected function _insertSpData($test_device_id,$param)
    {
        $sp_data = [
            'test_device_id' => $test_device_id,
            'carrier_id' => $param['carrier_id'],
            'mobile_type' => $param['mobile_type'],
            'number' => $param['number'],
            'mail_address' => $param['mail_address'],
            'wifi_line' => $param['wifi_line'],
            'communication_line' => $param['communication_line'],
            'sim_card' => $param['sim_card'],
            'charger_type' => $param['charger_type'],
            'resolution' => $param['resolution'],
            'display_size' => $param['display_size'],
            'memo' => $param['memo'],
            'admin_memo' => $param['admin_memo']
        ];
        return \DB::table('test_device_mobile')->insert($sp_data);
    }

    protected function _insertMobileInstalledApp($test_device_id,$param)
    {
        $data = [
            'test_device_id'=>$test_device_id,
            'software_id' =>$param['mobile_app_id']
        ];
        return $this->_mobile_installed_app_model->insertMobileInstalledApp($data);
    }
}
