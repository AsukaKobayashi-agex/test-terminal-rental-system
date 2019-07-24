<?php

namespace Rental\Models\_common;

class MobileInstalledAppData
{
    public function insertMobileInstalledApp($test_device_id,$param)
    {
        $now = nowDateTime();

        foreach($param['mobile_app_id'] as $mobile_app_id){
            $insert_data = [
                'test_device_id' =>$test_device_id,
                'mobile_app_id' =>$mobile_app_id,
                'add_date' =>$now
            ];

            \DB::table('mobile_installed_app')->insert($insert_data);
        }
        return true;
    }
}
