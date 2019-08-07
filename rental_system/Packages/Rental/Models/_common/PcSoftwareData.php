<?php

namespace Rental\Models\_common;

class PcSoftwareData
{


    public function updatePcSoftware($test_device_id,$software_id)
    {
        $now = nowDateTime();
        $installed = stdClassToArray(\DB::table('pc_software')->select('software_id')->where('test_device_id','=',$test_device_id)->pluck('software_id'));
        $add_software = array_diff($software_id,$installed);
        $delete_software = array_diff($installed,$software_id);
        foreach($add_software as $id){
            $insert_data = [
                'test_device_id' =>$test_device_id,
                'software_id' =>$id,
                'software_add_date' =>$now
            ];

            \DB::table('pc_software')->insert($insert_data);
        }
        foreach($delete_software as $id){
            $delete_data = [
                ['test_device_id','=',$test_device_id],
                ['software_id','=',$id]
            ];

            \DB::table('pc_software')->where($delete_data)->delete();
        }
        return true;
    }

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
