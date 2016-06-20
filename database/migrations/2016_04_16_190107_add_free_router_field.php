<?php

use App\ListingField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreeRouterField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();

        if(! ListingField::where('name', 'Free Router')->first() && ListingField::count() != 0) {
            $listing = ListingField::create([
                'name' => 'Free Router',
                'type' => 'dropmenu',
                'settings' => json_encode([
                    'format' => 'dropmenu'
                ]),
                'service_id' => 12,
                'category_id' => 43
        ]);

            $listing->createTranslation('name', 'راوتر مجاني');
            $option = $listing->options()->create(['name' => 'Yes']);
            $option->createTranslation('name', 'نعم');
            $option = $listing->options()->create(['name' => 'No']);
            $option->createTranslation('name', 'لا');
        }


        Model::reguard();
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
