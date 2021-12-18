<?php

namespace App\Services\Users;

use Illuminate\Http\Request;
use App\Contracts\Users\UsersRepositoryInterface;

class UsersService
{
    protected $user_repository;

    public function __construct(UsersRepositoryInterface $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function all()
    {
        return $this->user_repository->getUsers();
    }

    public function create(Request $request)
    {
        $attributes = $request->except('password');
        $attributes['tenant_id'] = auth()->user()->tenant_id;
        $attributes['password'] = bcrypt($request->password);
        return $this->user_repository->create($attributes);
    }

    public function getById($id)
    {
        $relationships = ['tenant'];
        return $this->user_repository->getByIdWithRelationship($id, $relationships);
    }

    public function delete($id)
    {
        $user = $this->getById($id);

        if($user)
        {
            return $this->user_repository->delete($user[0]);
        }else
        {
            return false;
        }
    }

    public function search(Request $request)
    {
        $param = $request->filter;
        return $this->user_repository->search($param);
    }

    public function update(Request $request, $userID)
    {
        $user = $this->getById($userID);
        $attributes = $request->all();
        $attributes['password'] = bcrypt($request->pssword);
        return $this->user_repository->update($user[0], $attributes);
    }
}
?>
