<?php

namespace App\Services\ProjectService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProjectService\Models\Category;
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
