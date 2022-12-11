<?php

namespace App\Services\BaseService\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
        //
    }

    /**
     * @param array $queries
     * @return LengthAwarePaginator|Collection
     */
    public function list(array $queries = []): LengthAwarePaginator|Collection
    {
        $models = $this->model->query();

        $models = $this->applyFilters($models, $queries);

        if (isset($queries['paginate']) && !$queries['paginate'])
            return $models->get();
        else
            return $models->paginate($queries['per_page'] ?? $this->model->getPerPage());
    }

    /**
     * @param Builder $models
     * @param array $queries
     * @return Builder
     */
    protected function applyFilters(Builder $models, array $queries = []): Builder
    {
        return $models;
    }

    /**
     * @param array $parameters
     * @return Model
     */
    public function create(array $parameters): Model
    {
        return $this->model->query()
            ->create($parameters);
    }

    /**
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model
    {
        return $model;
    }

    /**
     * @param Model $model
     * @param array $parameters
     * @return Model
     */
    public function update(Model $model, array $parameters): Model
    {
        $model->update($parameters);

        return $model->refresh();
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * Find an exact record by given key-value.
     *
     * @param string $key
     * @param string $value
     * @return Model|null
     */
    public function findBy(string $key, string $value): Model|null
    {
        return $this->model->where($key, $value)->first();
    }
}
