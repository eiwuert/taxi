<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFiveMoreColumnsToDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('identity_number')->nullable();
            $table->string('identity_code')->nullable();
            $table->boolean('abuse_history')->default(false);
            $table->boolean('drug_abuse')->default(true);
            $table->string('credit_card')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn(['identity_number', 'identity_code', 'abuse_history',
                'drug_abuse', 'credit_card']);
        });
    }
}
