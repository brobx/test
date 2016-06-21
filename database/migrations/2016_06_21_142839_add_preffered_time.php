<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrefferedTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->enum('preffered_call_time', ['9 a.m. - 12 p.m', '12 p.m. - 3 p.m', '3 a.m. - 6 p.m', '6 a.m. - 9 p
            .m'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn('preffered_call_time');
        });
    }
}
