<?php

namespace App\Services\ProjectService\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CategoryCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var Collection
     */
    public $collection = CategoryResource::class;
}
