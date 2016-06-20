<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyListingsAddImpressionsClicksTargetedImpressions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->unsignedInteger('clicks');
            $table->unsignedInteger('impressions');
            $table->unsignedInteger('targeted_impressions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn(['clicks', 'impressions', 'targeted_impressions']);
        });
    }
}
