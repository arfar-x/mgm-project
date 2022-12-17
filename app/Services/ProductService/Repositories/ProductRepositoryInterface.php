<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProductService\Models\Product;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Product $product
     * @param string $uuid
     * @return Product
     */
    public function setCoverUuid(Product $product, string $uuid): Product;
}