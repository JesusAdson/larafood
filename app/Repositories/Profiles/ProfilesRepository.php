<?php

namespace App\Repositories\Profiles;

use App\Repositories\BaseRepository;
use App\Contracts\Profiles\ProfilesRepositoryInterface;
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
}
?>
