<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('last_name',50)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone',14)->nullable();
            $table->string('photo_url')->nullable();
            $table->enum('gender', ['s', 'm'])->nullable();
            $table->string('password')->nullable();
            $table->string('id_card')->nullable();
            $table->integer('active')->default(0);
            $table->string('locale',10)->nullable();
            $table->softDeletes();
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
        Schema::drop('users');
    }
}
