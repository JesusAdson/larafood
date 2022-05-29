<?php

namespace App\Repositories\Categories;

use App\Repositories\BaseRepository;
use App\Contracts\Categories\CategoriesRepositoryInterface;
use App\Models\Category;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
  /**
    * DetailsPlanRepository constructor.
    *
    * @param Category $model
    */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function search(?string $param = null)
    {
      return $this->model
        ->where(function ($query) use ($param) {
          $query->when(!is_null($param), function ($query) use ($param){
            $query
              ->orWhere('description', 'LIKE', "%{$param}%")
              ->orWhere('name', 'LIKE', "%{$param}%");
          });
        })
        ->latest()
        ->paginate();
    }
}
?>
