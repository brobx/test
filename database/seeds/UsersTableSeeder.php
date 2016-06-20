<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kite Developer',
            'email' => 'dev@kite.agency',
            'password' => bcrypt('123456'),
            'role_id' => 3,
        ]);
    }
}
