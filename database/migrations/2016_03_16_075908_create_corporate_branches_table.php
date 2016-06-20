<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('corporate_id');
            $table->string('address');
            $table->string('phone');
            $table->string('working_hours');
            $table->double('longitude');
            $table->double('latitude');
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
        Schema::drop('corporate_branches');
    }
}
