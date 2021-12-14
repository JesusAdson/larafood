<?php

namespace App\Contracts\Profiles;

use Illuminate\Database\Eloquent\Model;
use App\Contracts\BaseRepositoryInterface;

interface ProfilesRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get a profile with a relashionship
     * @param int $id
     * @param array $relashionships
     * @return Model
     */

    public function getPermissions(int $id, array $relashionships);

    /**
     * Attach a permission on a profile
     * @param int $profileID
     * @param array $permissions
     */

    public function attachPermissions(array $permissions, $profileID);

    /**
     * Detach a permission on a profile
     * @param int $profileID
     * @param int $permissionID
     */
    public function detachPermissions(int $profileID, int $permissionID);

    /**
     * Get all profiles that ain't linked with a plan
     * @param int $planID
     */
    public function availableProfiles(int $planID);

    /**
     * Get all permissions that ain't linked with a profile by a filter
     * @param int $planID
     * @param string $filter
     */

    public function availableProfilesWithFilters(string $filter, int $planID);

    /**
     * Get all plans linked with a profile
     * @param int $profileID
     * @param array $relashionships
     */
    public function getPlans(int $profileID, array $relashionships);
}
