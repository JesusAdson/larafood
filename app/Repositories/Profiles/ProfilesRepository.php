<?php

namespace App\Repositories\Profiles;

use App\Repositories\BaseRepository;
use App\Contracts\Profiles\ProfilesRepositoryInterface;
use App\Models\Permission;
use App\Models\Plan;
use App\Models\Profile;

class ProfilesRepository extends BaseRepository implements ProfilesRepositoryInterface
{
    /**
    * PlansRepository constructor.
    *
    * @param Profile $model
    */
    public function __construct(Profile $model)
    {
        parent::__construct($model);
    }

    public function getPermissions(int $id, array $relashionships)
    {
        $profile = $this->model->with($relashionships)->where('id', $id)->first();
        return $profile->permissions()->paginate();
    }

    public function getPlans(int $id, array $relashionships)
    {
        $profile = $this->model->with($relashionships)->where('id', $id)->first();
        return $profile->plans()->paginate();
    }

    public function attachPermissions(array $permissions, $profileID)
    {
        $profile = $this->model->where('id', $profileID)->first();
        return $profile->permissions()->attach($permissions);
    }

    public function detachPermissions(int $profileID, int $permissionID)
    {
        $profile = $this->model->where('id', $profileID)->first();
        $permission = Permission::where('id', $permissionID)->first();
        return $profile->permissions()->detach($permission);
    }

    public function availableProfiles(int $planID)
    {
        $permissions = Profile::whereNotIn('id', function($query) use ($planID){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$planID}");
        })->paginate();

        return $permissions;
    }

    public function availableProfilesWithFilters($filter = null, $planID)
    {
        $profile = Profile::whereNotIn('profiles.id', function($query) use ($planID){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$planID}");
        })
        ->when($filter != null, function($query) use($filter){
            $query->where('profiles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $profile;
    }
}
?>
