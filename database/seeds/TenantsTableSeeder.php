<?php

use App\Models\{
    Plan,
    Tenant
};
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create(
            [
                'cnpj' => '23881236000120',
                'name' => 'Bussisness',
                'url' => 'bussisness',
                'email' => 'bussissnes@gmail.com'
            ]
        );
    }
}
