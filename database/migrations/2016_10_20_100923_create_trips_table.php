<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('driver_id');
            $table->foreign('driver_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('status', [1, 2, 3, 4, 5]);
            $table->unsignedInteger('source');
            $table->foreign('source')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->unsignedInteger('destination');
            $table->foreign('destination')
                  ->references('id')->on('locations')
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
        Schema::dropIfExists('trips');
    }
}
