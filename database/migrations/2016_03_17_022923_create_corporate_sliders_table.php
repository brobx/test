<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->text('description')->nullable();
            $table->boolean('activated')->default(true);
            $table->unsignedInteger('corporate_id');
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
        Schema::drop('corporate_sliders');
    }
}
