<?php

namespace App\Services\MediaService\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MediaCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var \Illuminate\Support\Collection
     */
    public $collects = MediaResource::class;
}
