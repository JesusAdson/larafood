<?php

namespace App\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllPaginated(?int $limit = 10)
    {
        return $this->model->latest()->paginate($limit);
    }

    public function create(array $request): Model
    {
        DB::beginTransaction();
        try{
            $model = $this->model->create($request);
        }catch(Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
        }
        DB::commit();
        return $model;
    }

    public function getById(int $id, ?array $relationship = null): Model
    {
        return $this->model
            ->where('id', $id)
            ->first();
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

    public function update(Model $model, array $attributes)
    {
        DB::beginTransaction();
        try{
            $model->update($attributes);
        }catch(Exception $e){
            DB::rollback();
        }
        DB::commit();
        return $model;
    }

}

?>
