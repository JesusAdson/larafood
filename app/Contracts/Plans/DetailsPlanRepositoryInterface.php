<?php
namespace App\Contracts\Plans;

use Illuminate\Database\Eloquent\Model;

interface DetailsPlanRepositoryInterface
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
