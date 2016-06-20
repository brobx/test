<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('type_id');
            $table->boolean('suspended')->default(false);
            $table->timestamps();

            $table->foreign('type_id')
                  ->references('id')
                  ->on('corporate_types')
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
        Schema::drop('corporates');
    }
}
