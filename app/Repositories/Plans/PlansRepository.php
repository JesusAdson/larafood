<?php

namespace App\Repositories\Plans;

use App\Models\Plan;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Plans\PlansRepositoryInterface;
use App\Models\Profile;

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

    public function getProfiles(int $id, array $relationships)
    {
        $plan = $this->model->with($relationships)->where('id', $id)->first();
        return $plan->profiles()->paginate();
    }

    public function attachProfiles(int $planID, array $profiles)
    {
        $plan = $this->model->where('id', $planID)->first();
        return $plan->profiles()->attach($profiles);
    }

    public function detachProfile(int $planID, int $profileID)
    {
        $plan = $this->model->where('id', $planID)->first();
        $profile = Profile::where('id', $profileID)->first();
        return $plan->profiles()->detach($profile);
    }
}
?>
