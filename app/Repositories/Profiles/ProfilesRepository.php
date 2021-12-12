<?php

namespace App\Repositories\Profiles;

use App\Repositories\BaseRepository;
use App\Contracts\Profiles\ProfilesRepositoryInterface;
use App\Models\Permission;
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
}
?>
