<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ProductService\Models\Product;

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
     * @param string $uuid
     * @return Product
     */
    public function setCoverUuid(Product $product, string $uuid): Product
    {
        return $this->update($product, [
            'cover' => $uuid
        ]);
    }
}
