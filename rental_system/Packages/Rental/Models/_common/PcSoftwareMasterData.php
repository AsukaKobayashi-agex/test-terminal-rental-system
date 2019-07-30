<?php

namespace Rental\Models\_common;

class PcSoftwareMasterData
{
    const TABLE_NAME = 'pc_software_master';

    public function insertPcSoftwareMaster($param)
    {
        $insert_data = [
            'software_name' =>mb_convert_kana($param['software_name'],"KVnr")
        ];

        return \DB::table(self::TABLE_NAME)->insertGetId($insert_data);
    }

    public function getAll()
    {
        $data = stdClasstoarray(\DB::table(self::TABLE_NAME)->orderby('software_id','DESC')->get());
        return $data;
    }

    public function delete($id)
    {
        \DB::table(self::TABLE_NAME)->where('software_id','=',$id)->delete();
        \DB::table('pc_software')->where('software_id','=',$id)->delete();
        return true;
    }

    public function rename($param)
    {
        $update_data=[
            'software_name' => $param['software_name']
        ];

        \DB::table(self::TABLE_NAME)->where('software_id','=',$param['software_id'])->update($update_data);
        return true;
    }

}
