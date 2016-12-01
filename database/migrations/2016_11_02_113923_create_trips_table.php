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
            $table->unsignedInteger('driver_id')
                  ->nullable();
            $table->foreign('driver_id')
                  ->references('id')->on('drivers')
                  ->onDelete('cascade');
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')
                  ->references('id')->on('clients')
                  ->onDelete('cascade');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')
                  ->references('id')->on('status')
                  ->onDelete('cascade');
            $table->unsignedInteger('source');
            $table->foreign('source')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->unsignedInteger('destination');
            $table->foreign('destination')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->string('eta_value');
            $table->string('eta_text');
            $table->string('distance_value');
            $table->string('distance_text');
            $table->string('etd_value')->nullable();
            $table->string('etd_text')->nullable();
            $table->unsignedInteger('driver_location')->nullable();
            $table->foreign('driver_location')
                  ->references('id')->on('locations')
                  ->onDelete('cascade');
            $table->string('driver_distance_value')->nullable();
            $table->string('driver_distance_text')->nullable();
            $table->unsignedInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')
                  ->references('id')->on('transactions')
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
