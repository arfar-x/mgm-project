<?php

namespace App\Services\ProjectService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\ProjectService\Models\Category;
use App\Services\ProjectService\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param Project $project
     * @param string $uuid
     * @return Project|Model
     */
    public function setCoverUuid(Project $project, string $uuid): Project|Model;

    /**
     * Get projects by given category model.
     *
     * @param Category $category
     * @param array $queries
     * @return LengthAwarePaginator|Collection
     */
    public function getProjectsByCategory(Category $category, array $queries = []): LengthAwarePaginator|Collection;

    /**
     * Change project category explicitly.
     *
     * @param Project $project
     * @param array $parameters
     * @return Project|bool|Model
     */
    public function changeCategory(Project $project, array $parameters): Project|bool|Model;

    /**
     * @param Project $project
     * @return Collection
     */
    public function getTags(Project $project): Collection;
}
