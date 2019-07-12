<?php

namespace Rental\Models\_common;

class UserData
{
 public function insertUser($data)
 {
     $default_time = 1900/1/1;
     $insert_data = [

     ];

     $user_id = \DB::table('user')->insertGetId($insert_data);
     return $user_id;
 }
}
