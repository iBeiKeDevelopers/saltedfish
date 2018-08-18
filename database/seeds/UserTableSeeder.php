<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $uid = DB::table('users_common')->insertGetId([
            'nick_name'     =>      str_random(),
            'email'         =>      str_random(5) . "@" . str_random(3) . ".com",
            'password'      =>      md5(str_random(3)),
        ]);

        DB::table('users_identity')->insert([
            'id'            =>      $uid,
            'degree'        =>      random_int(0,2),
            'student_id'    =>      random_int(1000,4200) . random_int(1000,2000),
        ]);

        DB::table('users_contact')->insert([
            'id'            =>      $uid,
            'college'       =>      str_random(4),
            'domitory'      =>      random_int(1,12),
            'room'          =>      random_int(1,10) . random_int(1,70),
            'phone'         =>      random_int(12300,18900) . random_int(10000,99999) . random_int(1,9),
        ]);

        //DB::table('users_extend')->insert([]);
    }
}
