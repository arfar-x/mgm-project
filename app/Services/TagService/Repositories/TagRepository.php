<?php

namespace App\Services\TagService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\TagService\Models\Tag;
use Illuminate\Database\Eloquent\Model;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    /**
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    /**
     * Set tags for a related model.
     *
     * @param array $tags
     * @param Model|null $model
     * @return array
     */
    public function syncTags(array $parameters, Model $model = null): array
    {
        $tagModel = $model ? $model->taggable() : $this->model;

        return $tagModel->sync($parameters);
    }

    /**
     * Detach all tags of a model.
     *
     * @param Model|null $model
     * @return bool
     */
    public function detachTags(Model $model = null): bool
    {
        $tagModel = $model ? $model->taggable() : $this->model;

        return $tagModel->detach();
    }
}
