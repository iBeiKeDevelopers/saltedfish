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
        $gid = DB::table('goods_common')->insertGetId([
            'title'         =>      str_random(),
            'owner'         =>      random_int(1,50),
            'type'          =>      random_int(0,3),
            'status'        =>      random_int(0,3),
            'cost'          =>      random_int(100,1000) / random_int(1,10),
            'fee'           =>      random_int(100,1000) / random_int(1,10),
            'remain'        =>      random_int(20,100),
            'description'   =>      str_random(random_int(20,256)),
            'category'      =>      str_random(),
        ]);

        DB::table('goods_image')->insert([
            'gid'           =>      $gid,
            'src'           =>      'storage/none.jpg',
        ]);

        DB::table('goods_comments')->insert([
            'gid'           =>      $gid,
            'uid'           =>      random_int(1,50),
            'uname'         =>      'anoymous',
            'avatar'        =>      '',
            'content'       =>      str_random(32),
        ]);

        DB::table('goods_browse')->insert([
            'id'            =>      $gid,
            'heat'          =>      random_int(0,50),
            'view'          =>      random_int(50,500),
        ]);
    }
}
