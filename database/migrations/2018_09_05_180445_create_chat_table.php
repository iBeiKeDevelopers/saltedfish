<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('chat_rooms', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->timestamps();
        // });

        Schema::create('chat_history', function (Blueprint $table) {
            $table->increments('id');

            $table->string('content');
            $table->string('type');
            $table->integer('from');
            $table->integer('to');
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
        //Schema::dropIfExists('chat_rooms');
        Schema::dropIfExists('chat_history');
    }
}
