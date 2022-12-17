<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProductService\Models\Attribute;
use App\Services\ProductService\Models\Product;
use Illuminate\Support\Collection;

interface AttributeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Create product's attributes by relation.
     *
     * @param Product $product
     * @param array $attributes
     * @return Collection
     */
    public function setProductAttributes(Product $product, array $attributes): array;

    /**
     * Update product's attributes by relation.
     *
     * @param Product $product
     * @param array $attributes
     * @return void
     */
    public function updateProductAttributes(Product $product, array $attributes): void;
}