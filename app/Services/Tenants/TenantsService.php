<?php

namespace App\Services\Tenants;

use Illuminate\Http\Request;
use App\Contracts\Tenants\TenantsRepositoryInterface;
use App\Services\Plans\PlansService;

class TenantsService
{
    protected $tenants_repository, $plan_service;

    public function __construct(TenantsRepositoryInterface $tenants_repository, PlansService $plan_service)
    {
        $this->tenants_repository = $tenants_repository;
        $this->plan_service = $plan_service;
    }

    public function create(array $data, int $planID)
    {
        return $this->tenants_repository->create($data, $planID);
    }

}
?>
