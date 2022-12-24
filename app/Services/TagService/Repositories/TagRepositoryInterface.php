<?php

namespace App\Services\TagService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Set tags for a related model.
     *
     * @param array $tags
     * @param Model|null $model
     * @return array
     */
    public function syncTags(array $parameters, Model $model = null): array;

    /**
     * Detach all tags of a model.
     *
     * @param Model|null $model
     * @return bool
     */
    public function detachTags(Model $model = null): bool;
}
