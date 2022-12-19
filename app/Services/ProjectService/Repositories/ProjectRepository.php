<?php

namespace App\Services\ProjectService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ProjectService\Repositories\ProjectRepositoryInterface;
use App\Services\ProjectService\Models\Category;
use App\Services\ProjectService\Models\Project;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * Set project's cover by given UUID.
     *
     * @param Project $project
     * @param string $uuid
     * @return Project
     */
    public function setCoverUuid(Project $project, string $uuid): Project
    {
        return $this->update($project, [
            'cover' => $uuid
        ]);
    }

    /**
     * Get projects by given category model.
     *
     * @param Category $category
     * @return Collection
     */
    public function getProjectsByCategory(Category $category, array $queries = []): LengthAwarePaginator|Collection
    {
        $models = $category->Projects();

        $models->orderBy($queries['sort_by'] ?? 'created_at', $queries['sort_direction'] ?? 'desc');
        $models->when(isset($queries['active']), function ($models) use ($queries){
            $models->where('status', $queries['active']);
        });

        if (isset($queries['paginate']) && !$queries['paginate']) {
            return $models->get();
        } else {
            return $models->paginate($queries['per_page'] ?? $this->model->getPerPage());
        }
    }

    /**
     * Change project category explicitly.
     *
     * @param Project $project
     * @param array $parameters
     * @return Project|boolean
     */
    public function changeCategory(Project $project, array $parameters): Project|bool
    {
        try {

            return $this->update($project, ['category_id' => $parameters['category_id']]);

        } catch (QueryException $exception) {

            Log::error("Project ID: $project->id: " . $exception->getMessage());

            return false;
        }
    }

    /**
     * @param Project $project
     * @return Collection
     */
    public function getTags(Project $project): Collection
    {
        return $project->taggable()->get();
    }
}
