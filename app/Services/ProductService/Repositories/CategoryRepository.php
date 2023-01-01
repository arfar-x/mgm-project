<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ProductService\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * Set category's cover by given UUID.
     *
     * @param Category $category
     * @param string|null $uuid
     * @return Category|Model
     */
    public function setCoverUuid(Category $category, string $uuid = null): Category|Model
    {
        return $this->update($category, [
            'cover' => $uuid
        ]);
    }
}
