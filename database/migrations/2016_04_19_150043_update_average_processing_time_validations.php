<?php

use App\ListingField;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAverageProcessingTimeValidations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $fields = ListingField::where('name', 'Average Processing Time')->get();
        
        foreach ($fields as $field) {
            $validation = $field->settings['validation'] . "|max:30";
            $field->settings = array_merge($field->settings, ['validation' => $validation]);
            $field->save();
        }
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
