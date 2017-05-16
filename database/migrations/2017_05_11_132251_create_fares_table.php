<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fares', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('zone_id');
            $table->foreign('zone_id')
                  ->references('id')->on('zones')
                  ->onDelete('cascade');
            $table->unsignedInteger('currency_id');
            $table->foreign('currency_id')
                  ->references('id')->on('currencies')
                  ->onDelete('cascade');
            $table->unique(['zone_id', 'currency_id']);
            $table->text('cost');
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
        Schema::dropIfExists('fares');
    }
}
