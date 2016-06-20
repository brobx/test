<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('overview')->nullable();
            $table->text('offers')->nullable();
            $table->text('details')->nullable();
            $table->text('benefits')->nullable();
            $table->text('eligibility')->nullable();
            $table->text('documents')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('url')->nullable();

            $table->unsignedInteger('corporate_id');
            $table->unsignedInteger('service_id');
            $table->timestamps();

            $table->foreign('corporate_id')
                  ->references('id')
                  ->on('corporates')
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
        Schema::drop('listings');
    }
}
