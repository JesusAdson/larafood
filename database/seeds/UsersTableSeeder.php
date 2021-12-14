<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'Adson Jesus',
                'email' => 'adsonjesus2014@gmail.com',
                'password' => bcrypt('adson1003')
            ]
        );
    }
}
