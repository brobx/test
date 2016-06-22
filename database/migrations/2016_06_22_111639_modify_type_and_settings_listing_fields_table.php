<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTypeAndSettingsListingFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('listing_fields')->where('name', 'Employer Type')->update([
            'type' => 'dropmenu',
            'settings' => '{"format":"dropmenu","validation":"required","default":null}'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('listing_fields')->where('name', 'Employer Type')->update([
            'type' => 'checkbox',
            'settings' => '{"format":"text","validation":"required","default":null}'
        ]);
    }
}
