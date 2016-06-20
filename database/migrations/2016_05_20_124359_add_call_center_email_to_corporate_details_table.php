<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCallCenterEmailToCorporateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('corporate_details', function(Blueprint $table)
        {
            $table->string('call_center_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('corporate_details', function(Blueprint $table)
        {
            $table->dropColumn('call_center_email');
        });
    }
}
