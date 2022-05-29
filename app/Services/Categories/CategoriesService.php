<?php

namespace App\Services\Categories;

use Illuminate\Http\Request;
use App\Contracts\Categories\CategoriesRepositoryInterface;
use App\Http\Requests\Category\StoreUpdateCategory;
use Exception;

class CategoriesService
{
    protected $categories_repository;

    public function __construct(CategoriesRepositoryInterface $categories_repository)
    {
        $this->categories_repository = $categories_repository;
    }

    public function all()
    {
        return $this->categories_repository->getAllPaginated();
    }

    public function create(StoreUpdateCategory $request)
    {
        $attributes = $request->all();
        return $this->categories_repository->create($attributes);
    }

    public function getById(int $id)
    {
        return $this->categories_repository->getById($id);
    }

    public function delete(int $id)
    {
        if(!$category = $this->getById($id))
        {
            return redirect()->back();
        }

        return $category->delete();
    }

    public function update(StoreUpdateCategory $request, int $id)
    {
        if(!$category = $this->getById($id))
        {
            return redirect()->back();
        }

        return $this->categories_repository->update($category, $request->all());
    }

    public function search(Request $request)
    {
        return $this->categories_repository->search($request->filter);
    }
}
?>
