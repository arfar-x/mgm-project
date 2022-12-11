<?php

namespace App\Services\BaseService\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @param array $queries
     * @return LengthAwarePaginator|Collection
     */
    public function list(array $queries = []): LengthAwarePaginator|Collection;

    /**
     * @param array $parameters
     * @return Model
     */
    public function create(array $parameters): Model;

    /**
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model;

    /**
     * @param Model $model
     * @param array $parameters
     * @return Model
     */
    public function update(Model $model, array $parameters): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool;
}
