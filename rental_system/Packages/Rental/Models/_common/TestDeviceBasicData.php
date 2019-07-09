<?php

namespace Rental\Models\_common;

class TestDeviceBasicData
{
    public function insertTestDeviceBasic($rental_device_id,$data,$param)
    {
        $insert_data = [
            'rental_device_id' =>$rental_device_id,
            'test_device_category' => $data['test_device_category'],
            'os' => $param['os']
        ];

        $test_device_id = \DB::table('test_device_basic')->insertGetId($insert_data);
        return $test_device_id;
    }
}
