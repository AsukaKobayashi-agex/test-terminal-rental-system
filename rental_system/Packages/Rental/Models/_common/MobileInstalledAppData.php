<?php

namespace Rental\Models\_common;

class MobileInstalledAppData
{
    public function insertMobileInstalledApp($param)
    {
        $now = nowDateTime();

        foreach($param['mobile_app_id'] as $mobile_app_id){
            $insert_data[] = [
                'test_device_id' =>$param['test_device_id'],
                'mobile_app_id' =>$mobile_app_id,
                'add_date' =>$now
            ];
        }
        return \DB::table('mobile_installed_app')->insert($insert_data);
    }
}
