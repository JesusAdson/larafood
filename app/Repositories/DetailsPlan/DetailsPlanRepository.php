<?php

namespace App\Repositories\DetailsPlan;

use App\Models\DetailPlan;
use App\Repositories\BaseRepository;
use App\Contracts\Details\DetailsPlanRepositoryInterface;

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
