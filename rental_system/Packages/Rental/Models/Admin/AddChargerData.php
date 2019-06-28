<?php

namespace Rental\Models\Admin;

use Rental\Models\_common\RentalDeviceData;

class AddChargerData
{
    protected $_rental_device_model;
    public function __construct(RentalDeviceData $rental_device)
    {
        $this->_rental_device_model = $rental_device;
    }

    public function insertChargerData($param)
    {
        // トランザクション開始
        \DB::beginTransaction();
        try {
            // レンタル品テーブルにデータを登録する
            $rental_device_id = $this->_insertRentalDevice();

            // todo: レンタル状態テーブルにデータを登録する

            // 充電機テーブルにデータを登録する
            $charger_id = $this->_insertCharger($rental_device_id, $param);

            // トランザクション終了
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return $charger_id;
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

    protected function _insertCharger($rental_device_id, $param)
    {
        $charger_data = [
            'rental_device_id' => $rental_device_id,
            'charger_name' => $param['charger_name'],
            'charger_type' => $param['charger_type']
        ];
        $charger_id = \DB::table('charger')->insertGetId($charger_data);
        return $charger_id;
    }
}
