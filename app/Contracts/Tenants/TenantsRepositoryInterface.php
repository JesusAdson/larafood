<?php

namespace App\Contracts\Tenants;

interface TenantsRepositoryInterface
{
    /**
    *Create an user and a tenant
    *@param array $data
    *@param int $planID
    */
    public function create(array $data, int $planID);
}
