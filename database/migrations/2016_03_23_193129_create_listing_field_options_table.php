<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingFieldOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_field_options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('listing_field_id');

            $table->foreign('listing_field_id')
                  ->references('id')
                  ->on('listing_fields')
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
        Schema::drop('listing_field_options');
    }
}
