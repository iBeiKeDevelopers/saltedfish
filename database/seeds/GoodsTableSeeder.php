<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('goods')->insert([
            'title'         =>      str_random(),
            'img'           =>      str_random(),
            'status'        =>      random_int(0,3),
            'type'          =>      random_int(0,3),
            'single_cost'   =>      random_int(20,100),
            'remain'        =>      random_int(20,100),
            'owner'         =>      random_int(0,5),
            'fee'           =>      str_random(4),
            'info'          =>      str_random(10),
        ]);
    }
}
