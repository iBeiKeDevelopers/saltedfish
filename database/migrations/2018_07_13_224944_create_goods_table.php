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
        Schema::create('goods_common', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');
            $table->string('owner');
            $table->integer('type');
            $table->integer('status')->default(0);
            $table->float('cost');
            $table->integer('remain');
            $table->text('description');
            $table->string('cat1');
            $table->string('cat2');
            $table->string('tags')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('goods_image', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gid');
            $table->string('path');
            $table->string('src');
        });

        Schema::create('goods_comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('gid');
            $table->integer('uid');
            $table->string('uname');
            $table->string('avatar')->nullable();
            $table->text('content');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('goods_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('heat')->default(0);
        });

        Schema::create('goods_browse', function (Blueprint $table) {
            $table->integer('gid');
            $table->integer('like')->default(0);
            $table->integer('view')->default(0);
            
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
        Schema::dropIfExists('goods_common');
        Schema::dropIfExists('goods_image');
        Schema::dropIfExists('goods_comments');
        Schema::dropIfExists('goods_tags');
        Schema::dropIfExists('goods_browse');
    }
}
