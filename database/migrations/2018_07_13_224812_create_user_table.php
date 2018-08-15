<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->char('account_number')->unique()->nullable();

            $table->string('student_id');
            $table->date('birthday')->nullable();
            $table->integer('degree')->nullable();
            $table->string('name')->nullable();
            $table->string('class')->nullable();
            $table->integer('domitory')->nullable();
            $table->integer('room')->nullable();
            $table->string('phone_number')->nullable();

            $table->integer('group')->default(1);
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
