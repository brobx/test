<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAdvertisementAddCorporateId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->unsignedInteger('corporate_id');

            $table->foreign('corporate_id')
                  ->references('id')
                  ->on('corporates')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropForeign(['corporate_id']);
            $table->dropColumn('corporate_id');
        });
    }
}
