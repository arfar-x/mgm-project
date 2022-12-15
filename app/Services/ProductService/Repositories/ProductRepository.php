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
}