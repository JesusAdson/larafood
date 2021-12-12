<?php
namespace App\Contracts\Permissions;

use App\Contracts\BaseRepositoryInterface;

interface PermissionsRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get profiles linked with a permission
     * @param int $permissionID
     * @param array $permissions
     */
    public function getProfiles(int $permissionID, array $permissions);
    /**
    * Get all permissions that ain't linked with a profile
    * @param int $profileID
    */

    public function availablePermissions(int $profileID);

    /**
    * Get all permissions that ain't linked with a profile by a filter
    * @param int $profileID
    * @param string $filter
    */

    public function availablePermissionsWithFilters(string $filter, int $profileID);
}
?>
