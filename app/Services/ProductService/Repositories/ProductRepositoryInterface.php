<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProductService\Models\Category;
use App\Services\ProductService\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Product $product
     * @param string $uuid
     * @return Product|Model
     */
    public function setCoverUuid(Product $product, string $uuid): Product|Model;

    /**
     * Get products by given category model.
     *
     * @param Category $category
     * @param array $queries
     * @return LengthAwarePaginator|Collection
     */
    public function getProductsByCategory(Category $category, array $queries = []): LengthAwarePaginator|Collection;

    /**
     * Change product category explicitly.
     *
     * @param Product $product
     * @param array $parameters
     * @return Product|bool|Model
     */
    public function changeCategory(Product $product, array $parameters): Product|bool|Model;

    /**
     * @param Product $product
     * @return Collection
     */
    public function getTags(Product $product): Collection;
}
