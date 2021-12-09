<?php

namespace App\Services\Profiles;

use Illuminate\Http\Request;
use App\Contracts\Profiles\ProfilesRepositoryInterface;

class ProfilesService
{
    protected $profile_repository;

    public function __construct(ProfilesRepositoryInterface $profile_repository)
    {
        $this->profile_repository = $profile_repository;
    }

    public function all()
    {
        return $this->profile_repository->getAllPaginated();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();
        return $this->profile_repository->create($attributes);
    }

    public function getById($id)
    {
        return $this->profile_repository->getById($id);
    }

    public function delete($id)
    {
        $profile = $this->profile_repository->getById($id);
        if($profile)
        {
            return $this->profile_repository->delete($profile);
        }else
        {
            return false;
        }
    }

    public function search(Request $request)
    {
        $param = $request->filter;
        return $this->profile_repository->search($param);
    }

    public function update(Request $request, $id)
    {
        $plan = $this->getById($id);
        $attributes = $request->all();
        if($plan)
        {
            return $this->profile_repository->update($plan, $attributes);
        }else{
            return false;
        }
    }
}
?>
