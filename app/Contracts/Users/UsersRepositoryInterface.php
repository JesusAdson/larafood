<?php
namespace App\Contracts\Users;

use App\Contracts\BaseRepositoryInterface;

interface UsersRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get a user with relationship
     * @param int $id
     * @param array $relationship
     */
    public function getByIdWithRelationship(int $id, array $relashionships);

    /**
     * Get Users with scope
     *
     */

     public function getUsers();

     /**
      * Search users with scope
      * @param string $param
      */

      public function searchUser(string $param = null);
}
?>
