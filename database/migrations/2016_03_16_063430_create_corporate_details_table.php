<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('corporate_id');
            $table->string('website');
            $table->string('phone');
            $table->string('email');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();

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
        Schema::drop('corporate_details');
    }
}
