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
        Schema::create('users_common', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nick_name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->integer('group')->default(0);
            
            $table->rememberToken();
            $table->timestamps();
        });
        DB::update('ALTER TABLE ibuy_users_common AUTO_INCREMENT = 3001');
        App\User::create([
            'nick_name' => 'ibuy管理员',
            'email' => 'admin@admin.com',
            'avatar' => '/storage/admin.png',
            'password' => Hash::make('aaaaaaaa'),
        ]);

        Schema::create('users_identity', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->integer('degree');
            $table->string('student_id');

            $table->timestamps();
        });

        Schema::create('users_contact', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('college');
            $table->integer('domitory');
            $table->integer('room');
            $table->string('phone');

            $table->timestamps();
        });

        Schema::create('users_extend', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->date('birthday')->nullable();
            $table->integer('credit')->default(60);

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
        Schema::dropIfExists('users_common');
        Schema::dropIfExists('users_identity');
        Schema::dropIfExists('users_contact');
        Schema::dropIfExists('users_extend');
    }
}
