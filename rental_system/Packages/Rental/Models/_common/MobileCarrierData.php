<?php

namespace Rental\Models\_common;

class MobileCarrierData
{
    const TABLE_NAME = 'mobile_carrier';

    public function  insertMobileCarrier($data)
    {
        $insert_data = [
            'carrier_name' =>$data['carrier_name']
        ];

        return \DB::table(self::TABLE_NAME)->insertGetId($insert_data);
    }

    public function getAll()
    {
        $data = \DB::table(self::TABLE_NAME)->get();
        return $data;
    }
}
