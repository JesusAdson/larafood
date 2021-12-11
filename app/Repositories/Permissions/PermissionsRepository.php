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
}
?>
