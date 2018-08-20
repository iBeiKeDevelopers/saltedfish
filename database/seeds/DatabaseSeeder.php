<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 200; $i++) {
            $this->call(GoodsTableSeeder::class);
        }

        for($i = 0; $i < 500; $i++) {
            $this->call(OrderTableSeeder::class);
        }

        for($i = 0; $i < 100; $i++) {
            $this->call(UserTableSeeder::class);
        }
    }
}
