<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trip_id')->unique();
            $table->foreign('trip_id')
                  ->references('id')->on('trips')
                  ->onDelete('cascade');
            $table->unsignedInteger('car_type_id');
            $table->foreign('car_type_id')
                  ->references('id')->on('car_types')
                  ->onDelete('cascade');
            $table->float('entry');
            $table->float('distance');
            $table->float('per_distance');
            $table->string('distance_unit');
            $table->string('distance_value');
            $table->float('time');
            $table->float('per_time');
            $table->string('time_unit');
            $table->string('time_value');
            $table->float('surcharge');
            $table->string('currency');
            $table->string('timezone');
            $table->float('total');
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
        Schema::dropIfExists('transactions');
    }
}
