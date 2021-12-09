<?php

namespace App\Repositories\Plans;

use App\Models\Plan;
use App\Contracts\Plans\PlansRepositoryInterface;
use App\Repositories\BaseRepository;
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
}
?>
