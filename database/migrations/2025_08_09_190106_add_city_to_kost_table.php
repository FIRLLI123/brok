<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCityToKostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kost', function (Blueprint $table) {
            if (!Schema::hasColumn('kost', 'city')) {
                $table->string('city')->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kost', function (Blueprint $table) {
            if (Schema::hasColumn('kost', 'city')) {
                $table->dropColumn('city');
            }
        });
    }
}
