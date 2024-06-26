<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ProductService\Models\Category;
use App\Services\ProductService\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Set product's cover by given UUID.
     *
     * @param Product $product
     * @param string|null $uuid
     * @return Product|Model
     */
    public function setCoverUuid(Product $product, string $uuid = null): Product|Model
    {
        return $this->update($product, [
            'cover' => $uuid
        ]);
    }

    /**
     * Get products by given category model.
     *
     * @param Category $category
     * @param array $queries
     * @return LengthAwarePaginator|Collection
     */
    public function getProductsByCategory(Category $category, array $queries = []): LengthAwarePaginator|Collection
    {
        $models = $category->products();

        $models->orderBy($queries['sort_by'] ?? 'created_at', $queries['sort_direction'] ?? 'desc');
        $models->when(isset($queries['active']), function ($models) use ($queries){
            $models->where('status', $queries['active']);
        });

        if (isset($queries['paginate']) && !$queries['paginate']) {
            return $models->get();
        } else {
            return $models->paginate($queries['per_page'] ?? $this->model->getPerPage());
        }
    }

    /**
     * Change product category explicitly.
     *
     * @param Product $product
     * @param array $parameters
     * @return Product|bool|Model
     */
    public function changeCategory(Product $product, array $parameters): Product|bool|Model
    {
        try {

            return $this->update($product, ['category_id' => $parameters['category_id']]);

        } catch (QueryException $exception) {

            Log::error("Product ID: $product->id: " . $exception->getMessage());

            return false;
        }
    }

    /**
     * @param Product $product
     * @return Collection
     */
    public function getTags(Product $product): Collection
    {
        return $product->taggable()->get();
    }
}
