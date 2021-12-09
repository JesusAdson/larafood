<?php

namespace App\Services\DetailsPlan;

use Illuminate\Http\Request;
use App\Contracts\Details\DetailsPlanRepositoryInterface;

class DetailsPlanService
{
    protected $details_plan_repository;

    public function __construct(DetailsPlanRepositoryInterface $details_plan_repository)
    {
        $this->details_plan_repository = $details_plan_repository;
    }

    public function all()
    {
        return $this->details_plan_repository->getAllPaginated();
    }

    public function create(Request $request, $plan)
    {
        if(!$plan) return false;

        $attributes = $request->all();
        $attributes['plan_id'] = $plan->id;
        return $this->details_plan_repository->create($attributes);
    }

    public function getById($id)
    {
        return $this->details_plan_repository->getById($id);
    }

    public function delete($id, $plan)
    {
        $detail_plan = $this->getById($id);

        if($detail_plan && $plan)
        {
            return $this->details_plan_repository->delete($detail_plan);
        }else
        {
            return false;
        }
    }

    public function search(Request $request)
    {
        $param = $request->filter;
        return $this->details_plan_repository->search($param);
    }

    public function update(Request $request, $plan, $detailId)
    {
        $detail = $this->getById($detailId);
        if(!$plan || !$detail) return false;

        $attributes = $request->all();
        return $this->details_plan_repository->update($detail, $attributes);
    }
}
?>
