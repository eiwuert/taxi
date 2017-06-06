<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTypeZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_type_zone', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_type_id')->unsigned()->nullable();
            $table->foreign('car_type_id')->references('id')
                  ->on('car_types')
                  ->onDelete('cascade');
            $table->integer('zone_id')->unsigned()->nullable();
            $table->foreign('zone_id')->references('id')
                  ->on('zones')
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
        Schema::dropIfExists('car_type_zone');
    }
}
