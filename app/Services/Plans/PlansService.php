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
        $plan = $this->getById($id);
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
}
?>
