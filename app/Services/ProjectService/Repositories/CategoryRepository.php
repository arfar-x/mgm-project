<?php

namespace App\Services\ProjectService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ProjectService\Models\Category;

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
     * @return Category
     */
    public function setCoverUuid(Category $category, string $uuid = null): Category
    {
        return $this->update($category, [
            'cover' => $uuid
        ]);
    }
}
