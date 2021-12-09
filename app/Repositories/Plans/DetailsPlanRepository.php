<?php

namespace App\Repositories\Plans;

use App\Models\DetailPlan;
use App\Repositories\BaseRepository;
use App\Contracts\Plans\DetailsPlanRepositoryInterface;

class DetailsPlanRepository extends BaseRepository implements DetailsPlanRepositoryInterface
{
  /**
    * DetailsPlanRepository constructor.
    *
    * @param DetailPlan $model
    */
    public function __construct(DetailPlan $model)
    {
        parent::__construct($model);
    }
}
?>
