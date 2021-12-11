<?php

namespace App\Services\Permissions;

use Illuminate\Http\Request;
use App\Contracts\Permissions\PermissionsRepositoryInterface;

class PermissionsService
{
    protected $permissions_repository;

    public function __construct(PermissionsRepositoryInterface $permissions_repository)
    {
        $this->permissions_repository = $permissions_repository;
    }

    public function all()
    {
        return $this->permissions_repository->getAllPaginated();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();
        return $this->permissions_repository->create($attributes);
    }

    public function getById($id)
    {
        return $this->permissions_repository->getById($id);
    }

    public function delete($id)
    {
        $profile = $this->permissions_repository->getById($id);
        if($profile)
        {
            return $this->permissions_repository->delete($profile);
        }else
        {
            return false;
        }
    }

    public function search(Request $request)
    {
        $param = $request->filter;
        return $this->permissions_repository->search($param);
    }

    public function update(Request $request, $id)
    {
        $plan = $this->getById($id);
        $attributes = $request->all();
        if($plan)
        {
            return $this->permissions_repository->update($plan, $attributes);
        }else{
            return false;
        }
    }
}
?>
