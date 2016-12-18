<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client')->nullable();
            $table->integer('driver')->nullable();
            $table->text('client_comment')->nullable();
            $table->text('driver_comment')->nullable();
            $table->unsignedInteger('trip_id')->unique();
            $table->foreign('trip_id')
                  ->references('id')->on('trips')
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
        Schema::dropIfExists('rates');
    }
}
