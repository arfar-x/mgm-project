<?php

namespace App\Services\TagService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\TagService\Models\Tag;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    /**
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }
}
