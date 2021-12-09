<?php
namespace App\Contracts\Plans;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface PlansRepositoryInterface
{
    /**
     * Return all plans available
     * @param null|int $limit
     */

    public function getAllPaginated(?int $limit = 20);

    /**
     * Create a new plan
     * @param array $request
     * @return Model
     */

    public function create(array $request): Model;

    /**
     * Get a plan by its ID
     * @param int $id
     * @return Model
     */

    public function getById(int $id): Model;

    /**
     * Get a plan by its ID with relashionships
     * @param int $id
     * @return Model
     */

     public function getByIdWithRelashionships(int $id): Model;

    /**
     * Delete a plan by its ID
     * @param Model $plan
     */
    public function delete(Model $plan);

    /**
     * Search a product by filter
     * @param string|null $param
     */

     public function search(string $param = null);

    /**
     * Update a plan by its ID
     * @param Model $plan
     * @param array $attributes
     */

     public function update(Model $plan, array $attributes);
}
?>
