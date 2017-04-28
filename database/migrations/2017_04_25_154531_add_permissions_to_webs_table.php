<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionsToWebsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webs', function (Blueprint $table) {
            // `after` is effective only for MySQL
            $table->text('permissions')->after('picture')->default(serialize([0]));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webs', function (Blueprint $table) {
            $table->dropColumn('permissions');
        });
    }
}
