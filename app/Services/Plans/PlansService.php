<?php

namespace App\Services\Plans;

use Illuminate\Http\Request;
use App\Contracts\Plans\PlansRepositoryInterface;
use Exception;

class PlansService
{
    protected $plans_repository;

    public function __construct(PlansRepositoryInterface $plans_repository)
    {
        $this->plans_repository = $plans_repository;
    }

    public function all()
    {
        return $this->plans_repository->getAllPaginated();
    }

    public function getAllWithRelationship()
    {
        $relationships = ['details'];
        return $this->plans_repository->getAllWithRelationship($relationships);
    }

    public function create(Request $request)
    {
        $attributes = $request->all();
        return $this->plans_repository->create($attributes);
    }

    public function getById($id)
    {
        return $this->plans_repository->getById($id);
    }

    public function delete($id)
    {
        $plan = $this->plans_repository->getByIdWithRelashionships($id);
        if($plan && $plan->details->count() == 0)
        {
            return $this->plans_repository->delete($plan);
        }else if($plan->details->count() > 0)
        {
            return ['error', 'Não é possível deletar um plano com detalhes!'];
        }else
        {
            return false;
        }
    }

    public function search(Request $request)
    {
        $param = $request->filter;
        return $this->plans_repository->search($param);
    }

    public function update(Request $request, $id)
    {
        $plan = $this->getById($id);
        $attributes = $request->all();
        if($plan)
        {
            return $this->plans_repository->update($plan, $attributes);
        }else{
            return false;
        }
    }

    public function getProfiles($id)
    {
        $relationships = ['profiles'];
        return $this->plans_repository->getProfiles($id, $relationships);
    }

    public function attachProfiles($planID, Request $request)
    {
        $this->plans_repository->attachProfiles($planID, $request->profiles);
    }

    public function detachProfile($planID, $profileID)
    {
        return $this->plans_repository->detachProfile($planID, $profileID);
    }

}
?>
