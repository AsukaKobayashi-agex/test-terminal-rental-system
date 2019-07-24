<?php

namespace Rental\Models\_common;


class MobileAppMasterData
{
    const TABLE_NAME = 'mobile_app_master';

    public function insertMobileAppMaster($param)
    {
        $insert_data = [
            'app_name' =>$param['app_name']
        ];

        return \DB::table(self::TABLE_NAME)->insertGetId($insert_data);
    }

    public function getAll()
    {
        $data = \DB::table(self::TABLE_NAME)->get();
        return $data;
    }

    public function getEdit()
    {
        $data = stdClasstoArray( \DB::table(self::TABLE_NAME)->get());
        return $data;
    }

}
