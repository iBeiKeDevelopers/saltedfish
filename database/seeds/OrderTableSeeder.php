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
        $i = random_int(1,200);
        $good = App\Models\Goods::find($i);
        DB::table('orders_common')->insert([
            'gid'       =>      $i,
            'title'     =>      $good->title,
            'owner'     =>      $good->owner,
            'cost'      =>      $good->cost,
            'uid'       =>      random_int(50,101),
            'status'    =>      random_int(0,2),
        ]);
    }
}
