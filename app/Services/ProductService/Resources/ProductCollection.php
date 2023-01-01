<?php

namespace App\Services\ProductService\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class ProductCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var Collection
     */
    public $collection = ProductResource::class;
}
