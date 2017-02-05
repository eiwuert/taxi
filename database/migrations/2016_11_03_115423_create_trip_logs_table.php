<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('driver_id')->nullable();
            $table->foreign('driver_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('trip_id');
            $table->foreign('trip_id')
                  ->references('id')->on('trips')
                  ->onDelete('cascade');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')
                  ->references('id')->on('status')
                  ->onDelete('cascade');
            $table->unsignedInteger('driver_location')->nullable();
            $table->foreign('driver_location')
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
        Schema::dropIfExists('trip_logs');
    }
}
