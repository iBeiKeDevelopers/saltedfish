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
        // $this->call(UsersTableSeeder::class);
        for($i = 0; $i < 50; $i++) {
            $this->call(GoodsTableSeeder::class);
        }

        for($i = 0; $i < 50; $i++) {
            $this->call(OrderTableSeeder::class);
        }

        for($i = 0; $i < 50; $i++) {
            $this->call(CommentTableSeeder::class);
        }
    }
}
