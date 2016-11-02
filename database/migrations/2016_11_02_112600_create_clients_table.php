<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->enum('sex', ['male', 'female', 'not specified'])->default('not specified');
            $table->string('device_token')->nullable();
            $table->enum('device_type', ['web', 'android', 'ios'])->default('web');
            $table->boolean('online')->default(0);
            $table->boolean('approve')->default(0);
            $table->boolean('available')->default(0);
            $table->integer('phone');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('clients');
    }
}
