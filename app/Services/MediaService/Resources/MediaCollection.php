<?php

namespace App\Services\MediaService\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaCollection extends JsonResource
{
    /**
     * The mapped collection instance.
     *
     * @var \Illuminate\Support\Collection
     */
    public $collection = MediaCollection::class;
}