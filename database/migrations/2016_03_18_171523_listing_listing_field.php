<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListingListingField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_listing_field', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('listing_id')->index();
            $table->unsignedInteger('listing_field_id')->index();
            $table->string('value');

            $table->foreign('listing_id')
                ->references('id')
                ->on('listings')
                ->onDelete('cascade');

            $table->foreign('listing_field_id')
                  ->references('id')
                  ->on('listing_fields')
                  ->onDelete('cascade');

            $table->unique(['listing_id', 'listing_field_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listing_listing_field');
    }
}
