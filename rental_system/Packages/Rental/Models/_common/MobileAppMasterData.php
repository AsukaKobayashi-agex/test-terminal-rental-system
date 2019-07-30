<?php

namespace Rental\Models\_common;


class
MobileAppMasterData
{
    const TABLE_NAME = 'mobile_app_master';

    public function insertMobileAppMaster($param)
    {
        $insert_data = [
            'app_name' => mb_convert_kana($param['app_name'],"KVnr"),
        ];

        return \DB::table(self::TABLE_NAME)->insertGetId($insert_data);
    }

    public function getAll()
    {
        $data = stdClassToArray(\DB::table(self::TABLE_NAME)->orderby('mobile_app_id','DESC')->get());
        return $data;
    }

    public function delete_app($app_id)
    {
        \DB::table(self::TABLE_NAME)->where('mobile_app_id','=',$app_id)->delete();
        \DB::table('mobile_installed_app')->where('mobile_app_id','=',$app_id)->delete();
        return true;
    }

    public function rename_app($param)
    {
        $update_data=[
            'app_name' => $param['app_name']
        ];

        \DB::table(self::TABLE_NAME)->where('mobile_app_id','=',$param['mobile_app_id'])->update($update_data);
        return true;
    }

}
