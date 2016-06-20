<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteShowAllOptionFromRewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $affected = \App\ListingFieldOption::whereHas('listingField', function ($q) {
            $q->where('name', 'Rewards');
        })->where('name', 'Show All')->delete();

        \Log::info("affected: " . $affected);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
