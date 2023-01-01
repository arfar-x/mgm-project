<?php

namespace App\Services\ProjectService\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ProjectCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var Collection
     */
    public $collection = ProjectResource::class;
}
