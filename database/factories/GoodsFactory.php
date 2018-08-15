<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        //
        'title'         =>      $faker->name,
        'img'           =>      $faker->name,
        'status'        =>      $faker->number,
        'type'          =>      $faker->number,
        'single_cost'   =>      $faker->number,
        'remain'        =>      $faker->number,
        'owner'         =>      $faker->name,
        'ttm'           =>      now(),
        'delivery_fee'  =>      $faker->number,
        'info'          =>      $faker->paragraph,
        //'comments'      =>     
        //'tags'
        //'cl'
    ];
});
