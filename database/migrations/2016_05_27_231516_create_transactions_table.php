<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->unsignedInteger('user_id')->index();
            $table->smallInteger('method'); // 0 unkown, 1 at agency, 2 credit card.
            $table->unsignedInteger('listing_id');
            $table->unsignedInteger('status'); // 0 pending, 1 failed, 2 success.
            $table->string('fort_id')->nullable();
            $table->timestamps();

            $table->foreign('listing_id')
                  ->references('id')
                  ->on('listings')
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
        Schema::drop('transactions');
    }
}
