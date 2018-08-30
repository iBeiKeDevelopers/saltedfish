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
            'title'         =>      str_random(random_int(8,32)),
            'owner'         =>      random_int(3001,3101),
            'type'          =>      random_int(0,1),
            'status'        =>      random_int(0,3),
            'cost'          =>      random_int(100,1000) / random_int(1,10),
            'remain'        =>      random_int(20,100),
            'description'   =>      str_random(random_int(20,256)),
            'cat1'          =>      str_random(4),
            'cat2'          =>      str_random(4),
        ]);

        $name = random_int(1,3) . '.jpg';
        DB::table('goods_image')->insert([
            'gid'           =>      $gid,
            'path'          =>      'storage/'.$name,
            'src'           =>      'storage/'.$name,
        ]);

        DB::table('goods_comments')->insert([
            'gid'           =>      $gid,
            'uid'           =>      random_int(1,50),
            'uname'         =>      'anoymous',
            'avatar'        =>      '/storage/3.png',
            'content'       =>      str_random(32),
        ]);

        DB::table('goods_browse')->insert([
            'gid'            =>      $gid,
            'like'          =>      random_int(0,50),
            'view'          =>      random_int(50,500),
        ]);

        $gid = DB::table('goods_common')->insertGetId([
            'title'         =>      str_random(random_int(8,32)),
            'owner'         =>      3001,
            'type'          =>      random_int(0,1),
            'status'        =>      random_int(0,3),
            'cost'          =>      random_int(100,1000) / random_int(1,10),
            'remain'        =>      random_int(20,100),
            'description'   =>      str_random(random_int(20,256)),
            'cat1'          =>      str_random(4),
            'cat2'          =>      str_random(4),
        ]);
        
        $name = random_int(1,3) . '.jpg';
        DB::table('goods_image')->insert([
            'gid'           =>      $gid,
            'path'          =>      '/storage'.'/'.$name,
            'src'           =>      '/storage'.'/'.$name,
        ]);

        DB::table('goods_browse')->insert([
            'gid'            =>      $gid,
            'like'          =>      random_int(0,50),
            'view'          =>      random_int(50,500),
        ]);
    }
}
