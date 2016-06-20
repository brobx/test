<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->unsignedInteger('service_type_id')->nullable();
            $table->unsignedInteger('corporate_type_id');
            $table->timestamps();

            $table->foreign('service_type_id')
                  ->references('id')
                  ->on('service_types')
                  ->onDelete('cascade');

            $table->foreign('corporate_type_id')
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
        Schema::drop('services');
    }
}
