<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unit')->nullable();
            $table->string('type')->nullable();
            $table->text('settings')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('service_id');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('listing_field_categories')
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
        Schema::drop('listing_fields');
    }
}
