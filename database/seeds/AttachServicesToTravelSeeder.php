<?php

use App\Corporate;
use Illuminate\Database\Seeder;

class AttachServicesToTravelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Corporate::where('type_id', 3)->get() as $corporate) {
            $corporate->servicesWithCommission()->sync($corporate->type->services()->lists('id')->toArray());
        }
    }
}
