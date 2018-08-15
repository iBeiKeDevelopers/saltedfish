<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('orders')->insert([
            'gid'       =>      random_int(0,50),
            'uid'       =>      random_int(0,20),
            'status'    =>      random_int(0,3),
        ]);
    }
}
