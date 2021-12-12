<?php

namespace App\Repositories\Permissions;

use App\Repositories\BaseRepository;
use App\Contracts\Permissions\PermissionsRepositoryInterface;
use App\Models\Permission;

class PermissionsRepository extends BaseRepository implements PermissionsRepositoryInterface
{
    /**
    * PlansRepository constructor.
    *
    * @param Permission $model
    */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function getProfiles(int $permissionID, array $relashionships)
    {
        $permission = $this->model->with($relashionships)->where('id', $permissionID)->first();
        return $permission->profiles()->paginate();
    }

    public function availablePermissions(int $profileID)
    {
        $permissions = Permission::whereNotIn('id', function($query) use ($profileID){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$profileID}");
        })->paginate();

        return $permissions;
    }

    public function availablePermissionsWithFilters($filter = null, $profileID)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query) use ($profileID){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$profileID}");
        })
        ->when($filter != null, function($query) use($filter){
            $query->where('permissions.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
    }
}
?>
