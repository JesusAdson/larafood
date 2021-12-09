<?php

namespace App\Repositories\Plans;

use App\Models\Plan;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Plans\PlansRepositoryInterface;

class PlansRepository extends BaseRepository implements PlansRepositoryInterface
{
    /**
    * PlansRepository constructor.
    *
    * @param Plan $model
    */
    public function __construct(Plan $model)
    {
        parent::__construct($model);
    }

    public function getByIdWithRelashionships(int $id): Model
    {
        return $this->model
            ->with('details')
            ->where('id', $id)
            ->first();
    }
}
?>
