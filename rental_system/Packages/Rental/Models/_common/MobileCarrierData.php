<?php

namespace Rental\Models\_common;

class MobileCarrierData
{
    const TABLE_NAME = 'mobile_carrier';

    public function  insertMobileCarrier($data)
    {
        $insert_data = [
            'carrier_name' => mb_convert_kana($data['carrier_name'],"KVnr")
        ];

        return \DB::table(self::TABLE_NAME)->insertGetId($insert_data);
    }

    public function getAll()
    {
        $data = stdClassToArray(\DB::table(self::TABLE_NAME)->orderby('carrier_id','DESC')->get());
        return $data;
    }

    public function delete($id)
    {
        $update = [
            'carrier_id' => 0
        ];
        \DB::table(self::TABLE_NAME)->where('carrier_id','=',$id)->delete();
        \DB::table('test_device_mobile')->where('carrier_id','=',$id)->update($update);
        return true;
    }

    public function rename($param)
    {
        $update_data=[
            'carrier_name' => $param['carrier_name']
        ];

        \DB::table(self::TABLE_NAME)->where('carrier_id','=',$param['carrier_id'])->update($update_data);
        return true;
    }

}
