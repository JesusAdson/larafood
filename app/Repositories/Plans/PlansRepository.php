<?php

namespace App\Repositories\Plans;

use App\Models\Plan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Plans\PlansRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class PlansRepository implements PlansRepositoryInterface
{
    protected $model;

    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }

    public function getAllPaginated(?int $limit = 10)
    {
        return $this->model->latest()->paginate($limit);
    }

    public function create(array $request): Model
    {
        DB::beginTransaction();
        try{
            $plan = $this->model->create($request);
        }catch(Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
        }
        DB::commit();
        return $plan;
    }

    public function getById(int $id): Model
    {
        return $this->model->where('id', $id)->first();
    }

    public function delete(Model $plan)
    {
        DB::beginTransaction();
        try{
            $plan->delete();
        }catch(Exception $e){
            DB::rollback();
        }
        DB::commit();
        return true;
    }

    public function search(string $param = null)
    {
        return $this->model
            ->where('name', 'LIKE', '%'.$param.'%')
            ->orderBy('name', 'ASC')
            ->paginate(1);
    }

    public function update(Model $plan, array $attributes)
    {
        DB::beginTransaction();
        try{
            $plan->update($attributes);
        }catch(Exception $e){
            DB::rollback();
        }
        DB::commit();
        return $plan;
    }

}

?>
