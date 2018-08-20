<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_common', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gid');
            $table->string('title');
            $table->integer('owner');
            $table->integer('uid');
            $table->float('cost');
            $table->integer('status');

            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_common');
    }
}
