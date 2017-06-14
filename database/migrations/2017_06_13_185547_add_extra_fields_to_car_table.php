<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraFieldsToCarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->timestamp('hull_insurance_expire')->nullable();
            $table->timestamp('third_party_insurance_expire')->nullable();
            $table->timestamp('technical_diagnosis_expire')->nullable();
            $table->string('technical_diagnosis_number')->nullable();
            $table->string('card')->nullable();
            $table->string('type_of')->nullable();
            $table->string('system')->nullable();
            $table->string('brigade')->nullable();
            $table->string('year')->nullable();
            $table->string('fuel')->nullable();
            $table->string('capacity')->nullable();
            $table->string('cylinder')->nullable();
            $table->string('axis')->nullable();
            $table->string('wheel')->nullable();
            $table->string('motor')->nullable();
            $table->string('chassis')->nullable();
            $table->string('vin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['hull_insurance_expire', 'third_party_insurance_expire', 
                'technical_diagnosis_expire', 'technical_diagnosis_number', 'card', 'type_of', 
                'system', 'brigade', 'year', 'fuel', 'capacity', 'cylinder', 
                'axis', 'wheel', 'motor', 'chassis', 'vin']);
        });
    }
}
