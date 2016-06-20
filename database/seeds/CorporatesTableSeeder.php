<?php

use App\Corporate;
use App\User;
use Illuminate\Database\Seeder;

class CorporatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedBank();
        $this->seedBroadband();
        $this->seedTravel();
    }

    /**
     *
     */
    protected function seedBank()
    {
        $corporate = Corporate::create(['name' => 'Piggy Bank', 'type_id' => 1]);
        $corporate->add(User::create([
            'name' => 'Mohammed Emad',
            'role_id' => 2,
            'corporate_role_id' => 1,
            'email' => 'emad@piggyBank.com',
            'password' => bcrypt('123456')
        ]));

        $corporate->details()->create([
            'website' => 'http://PiggyBank.dev',
            'email' => 'info@piggy.com',
            'phone' => '1231723781'
        ]);
    }

    /**
     *
     */
    protected function seedBroadband()
    {
        $corporate = Corporate::create(['name' => 'Orange', 'type_id' => 2]);
        $corporate->add(User::create([
            'name' => 'Mohammed Omad',
            'role_id' => 2,
            'corporate_role_id' => 1,
            'email' => 'emad@orange.com',
            'password' => bcrypt('123456')
        ]));

        $corporate->details()->create([
            'website' => 'http://orange.dev',
            'email' => 'info@orange.com',
            'phone' => '1231723781'
        ]);
    }

    /**
     *
     */
    protected function seedTravel()
    {
        $corporate = Corporate::create(['name' => 'Canal Tours', 'type_id' => 3]);
        $corporate->add(User::create([
            'name' => 'Mohammed Shehata',
            'role_id' => 2,
            'corporate_role_id' => 1,
            'email' => 'shehata@canal-tours.com',
            'password' => bcrypt('123456')
        ]));

        $corporate->details()->create([
            'website' => 'http://shehata.dev',
            'email' => 'info@orange.com',
            'phone' => '1231723781'
        ]);
    }
}
