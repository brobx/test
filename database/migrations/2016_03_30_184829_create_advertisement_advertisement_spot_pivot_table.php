<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementAdvertisementSpotPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_advertisement_spot', function (Blueprint $table) {
            $table->unsignedInteger('advertisement_id');
            $table->unsignedInteger('advertisement_spot_id');
            $table->unsignedInteger('service_id')->nullable();

            $table->foreign('advertisement_id')
                  ->references('id')
                  ->on('advertisements')
                  ->onDelete('cascade');

            $table->foreign('advertisement_spot_id')
                  ->references('id')
                  ->on('advertisement_spots')
                  ->onDelete('cascade');

            $table->foreign('service_id')
                  ->references('id')
                  ->on('services')
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
        Schema::drop('advertisement_advertisement_spot');
    }
}
