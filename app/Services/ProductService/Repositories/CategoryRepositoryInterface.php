<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProductService\Models\Category;
use Illuminate\Database\Eloquent\Model;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Set category's cover by given UUID.
     *
     * @param Category $category
     * @param string|null $uuid
     * @return Category|Model
     */
    public function setCoverUuid(Category $category, string $uuid = null): Category|Model;
}
