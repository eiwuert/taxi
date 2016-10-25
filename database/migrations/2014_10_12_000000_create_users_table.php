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
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('sex', ['male', 'female']);
            $table->string('email');
            $table->string('password');
            $table->string('picture')->default('no-profile.png');
            $table->string('device_token')->nullable();
            $table->enum('device_type', ['web', 'android', 'ios'])->default('web');
            $table->enum('login_by', ['manual', 'google', 'instagram'])
            	  ->default('manual');
            $table->string('social_id')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('online')->default(0);
            $table->boolean('approve')->default(0);
            $table->enum('role', ['driver', 'client', 'operator', 'admin'])
            	  ->default('client');
            $table->unique(['email', 'role']);
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
