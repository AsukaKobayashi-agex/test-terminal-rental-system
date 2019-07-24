<?php

namespace Rental\Models\_common;

class PcSoftwareMasterData
{
    const TABLE_NAME = 'pc_software_master';

    public function insertPcSoftwareMaster($param)
    {
        $insert_data = [
            'software_name' =>$param['software_name']
        ];

        return \DB::table(self::TABLE_NAME)->insertGetId($insert_data);
    }

    public function getEdit()
    {
        $data = stdClasstoArray( \DB::table(self::TABLE_NAME)->get());
        return $data;
    }

    public function getAdd()
    {
        //var_dump($param,1);
        $data = \DB::table(self::TABLE_NAME)->get();
        return $data;
    }

}
