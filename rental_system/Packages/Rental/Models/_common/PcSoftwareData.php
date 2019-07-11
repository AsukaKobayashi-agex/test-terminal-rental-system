<?php

namespace Rental\Models\_common;

class PcSoftwareData
{
    public function insertPcSoftware($param)
    {
        $now = nowDateTime();

        foreach($param['software_id'] as $software_id){
            $insert_data[] = [
                'test_device_id' =>$param['test_device_id'],
                'software_id' =>$software_id,
                'software_add_date' =>$now
            ];
        }
        return \DB::table('pc_software')->insert($insert_data);
    }
}
