<?php

use App\Models\Tenant;
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
        $tenant = Tenant::first();

        $tenant->users()->create(
            [
                'name' => 'Master',
                'email' => 'master@gmail.com',
                'password' => bcrypt('adson1003')
            ]
        );
    }
}
