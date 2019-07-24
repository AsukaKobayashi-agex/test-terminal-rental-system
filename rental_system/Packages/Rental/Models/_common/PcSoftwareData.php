<?php

namespace Rental\Models\_common;

class PcSoftwareData
{
    public function insertPcSoftware($test_device_id,$param)
    {
        $now = nowDateTime();

        foreach($param['software_id'] as $software_id){
            $insert_data = [
                'test_device_id' =>$test_device_id,
                'software_id' =>$software_id,
                'software_add_date' =>$now
            ];

            \DB::table('pc_software')->insert($insert_data);
        }
        return true;
    }
}
