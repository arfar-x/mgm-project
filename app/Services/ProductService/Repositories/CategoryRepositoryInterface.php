<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProductService\Models\Category;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Set category's cover by given UUID.
     *
     * @param Category $category
     * @param string $uuid
     * @return Category
     */
    public function setCoverUuid(Category $category, string $uuid): Category;
}
