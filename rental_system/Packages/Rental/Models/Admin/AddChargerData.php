<?php

namespace Rental\Models\Admin;

use Rental\Models\_common\RentalDeviceData;
use Rental\Models\_common\RentalStateData;
use Rental\Models\_common\AdminAccountData;


class AddChargerData
{
    protected $_get_admin_info;
    protected $_rental_device_model;
    protected $_rental_state_model;

    public function __construct(AdminAccountData $adminInfo,RentalDeviceData $rental_device, RentalStateData $rental_state)
    {
        $this->_get_admin_info = $adminInfo;
        $this->_rental_device_model = $rental_device;
        $this->_rental_state_model = $rental_state;

    }

    public function getAdminAccountData(){
        $admin_account_id = \Auth::guard('admin')->id();
        $admin_info = $this->_get_admin_info->getUserAuthDataById($admin_account_id);

        return $admin_info;
    }


    public function insertChargerData($param)
    {
        // トランザクション開始
        \DB::beginTransaction();
        try {
            // レンタル品テーブルにデータを登録する
            $rental_device_id = $this->_insertRentalDevice();

            // レンタル状態テーブルにデータを登録する
            $this->_insertRentalState($rental_device_id);

            // 充電機テーブルにデータを登録する
            $charger_id = $this->_insertCharger($rental_device_id, $param);

            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return $rental_device_id;
    }

    protected function _insertRentalDevice()
    {
        $data = [
            'device_category' => 2,     // 2: 充電機
            'archive_flag' => 0
        ];
        $rental_device_id = $this->_rental_device_model->insertRentalDevice($data);
        return $rental_device_id;
    }

    protected function _insertRentalState($rental_device_id)
    {
        return $this->_rental_state_model->insertRentalState($rental_device_id);
    }

    protected function _insertCharger($rental_device_id, $param)
    {
        //preDump($param,1);
        $charger_data = [
            'rental_device_id' => $rental_device_id,
            'charger_name' => mb_convert_kana($param['charger_name'],"KVnr"),
            'charger_type' => $param['charger_type']
        ];
        $charger_id = \DB::table('charger')->insertGetId($charger_data);
        return $charger_id;
    }
}
