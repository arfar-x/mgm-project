<?php

namespace App\Services\MediaService\Repositories;

use App\Services\MediaService\Models\Media;
use App\Services\MediaService\Repositories\Traits\Mediable;

class MediaRepository implements MediaRepositoryInterface
{
    use Mediable;

    /**
     * @param Media $model
     */
    public function __construct(protected Media $model)
    {
        $this->initMediable($model);
    }
}