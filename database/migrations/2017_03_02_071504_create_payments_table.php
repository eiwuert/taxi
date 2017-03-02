<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->unsignedInteger('trip_id')->unique();
            $table->foreign('trip_id')
                  ->references('id')->on('trips')
                  ->onDelete('cascade');
            $table->unsignedInteger('transaction_id')->unique();
            $table->foreign('transaction_id')
                  ->references('id')->on('transactions')
                  ->onDelete('cascade');
            $table->boolean('paid')->default(false);
            $table->enum('type', ['cash', 'card', 'wallet'])->nullable();
            $table->string('detail')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
