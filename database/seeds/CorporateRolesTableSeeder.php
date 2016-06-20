<?php

use App\CorporateRole;
use Illuminate\Database\Seeder;

class CorporateRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CorporateRole::create(['title' => 'manager']);
        CorporateRole::create(['title' => 'data-entry']);
    }
}
