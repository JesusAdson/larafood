<?php

namespace App\Repositories\Users;

use App\User;
use App\Models\DetailPlan;
use App\Repositories\BaseRepository;
use App\Contracts\Users\UsersRepositoryInterface;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{
  /**
    * DetailsPlanRepository constructor.
    *
    * @param User $model
    */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getByIdWithRelationship(int $id, array $relationships)
    {
        return $this->model
                ->latest()
                ->tenantScope()
                ->with($relationships)
                ->where('id', $id)
                ->orderBy('name', 'ASC')
                ->get();
    }

    public function getUsers()
    {
        return $this->model
                ->latest()
                ->tenantScope()
                ->paginate();
    }

    public function searchUser(string $param = null)
    {
        return $this->model
            ->latest()
            ->tenantScope()
            ->where('name', 'LIKE', '%'.$param.'%')
            ->orderBy('name', 'ASC')
            ->paginate(1);
    }
}
?>
