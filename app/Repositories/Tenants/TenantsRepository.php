<?php

namespace App\Repositories\Tenants;

use Exception;
use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Contracts\Tenants\TenantsRepositoryInterface;

class TenantsRepository implements TenantsRepositoryInterface
{

    protected $model;
    /**
     * DetailsPlanRepository constructor.
     * @param Tenants $model
     */
    public function __construct(Tenant $model)
    {
        $this->model = $model;
    }

    /**
     * Create a tenant by a plan &&
     * Create a user by a tenant
     */
    public function create(array $data, int $planID)
    {
        $plan = Plan::where('id', $planID)->first();

        $tenant = $plan->tenants()->create(
            [
                'cnpj' => $data['cnpj'],
                'name' => $data['empresa'],
                'email' => $data['email']
            ]
        );

        $user = $tenant->users()->create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password'])
            ]
        );
        return $user;
    }
}
