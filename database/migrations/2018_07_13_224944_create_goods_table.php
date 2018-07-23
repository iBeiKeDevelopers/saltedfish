<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('goods');
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('img');
            $table->integer('status');
            $table->integer('type');
            $table->char('single_cost');
            $table->integer('remain');
            $table->char('owner');
            //$table->dateTime('ttm')->nullable();
            $table->string('fee');
            //$table->text('search_summary')->nullable();
            $table->text('info')->nullable();
            //$table->text('comments')->nullable();
            $table->string('tags')->nullable();
            $table->string('cl_lv_1')->nullable();
            $table->string('cl_lv_2')->nullable();
            $table->string('cl_lv_3')->nullable();
            $table->integer('heat')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
