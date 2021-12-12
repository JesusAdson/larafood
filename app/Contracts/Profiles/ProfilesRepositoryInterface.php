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
}
?>
