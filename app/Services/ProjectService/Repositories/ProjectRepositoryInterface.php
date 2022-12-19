<?php

namespace App\Services\ProjectService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProjectService\Models\Category;
use App\Services\ProjectService\Models\Project;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Project $project
     * @param string $uuid
     * @return Project
     */
    public function setCoverUuid(Project $project, string $uuid): Project;

    /**
     * Get projects by given category model.
     *
     * @param Category $category
     * @return Collection
     */
    public function getProjectsByCategory(Category $category, array $queries = []): LengthAwarePaginator|Collection;

    /**
     * Change project category explicitly.
     *
     * @param Project $project
     * @param array $parameters
     * @return Project|boolean
     */
    public function changeCategory(Project $project, array $parameters): Project|bool;
}
