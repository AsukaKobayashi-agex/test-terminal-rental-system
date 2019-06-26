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
        // レンタル品テーブルにデータを登録する
        $data = [
            'device_category' => 2,     // 2: 充電機
            'archive_flag' => 0
        ];
        $rental_device_id = $this->_rental_device_model->insertRentalDevice($data);

        // 充電機テーブルにデータを登録する
        $charger_data = [
            'rental_device_id' => $rental_device_id,
            'charger_name' => $param['charger_name'],
            'charger_type' => $param['charger_type']
        ];
        $charger_id = \DB::table('charger')->insertGetId($charger_data);
        return $charger_id;
    }
}
