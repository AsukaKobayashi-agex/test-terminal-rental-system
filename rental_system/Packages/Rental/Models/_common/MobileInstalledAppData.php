<?php

namespace Rental\Models\_common;

class MobileInstalledAppData
{
    public function updateMobileInstalledApp($test_device_id,$app_id)
    {
        $now = nowDateTime();
        $installed = stdClassToArray(\DB::table('mobile_installed_app')->select('mobile_app_id')->where('test_device_id','=',$test_device_id)->pluck('mobile_app_id'));
        $add_app = array_diff($app_id,$installed);
        $delete_app = array_diff($installed,$app_id);
        foreach($add_app as $id){
            $insert_data = [
                'test_device_id' =>$test_device_id,
                'mobile_app_id' =>$id,
                'add_date' =>$now
            ];

            \DB::table('mobile_installed_app')->insert($insert_data);
        }
        foreach($delete_app as $id){
            $delete_data = [
                ['test_device_id','=',$test_device_id],
                ['mobile_app_id','=',$id]
            ];

            \DB::table('mobile_installed_app')->where($delete_data)->delete();
        }
        return true;
    }

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
