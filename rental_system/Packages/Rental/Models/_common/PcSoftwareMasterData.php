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

    public function getAll()
    {
        $data = stdClasstoarray(\DB::table(self::TABLE_NAME)->get());
        return $data;
    }

}
