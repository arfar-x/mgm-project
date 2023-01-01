<?php

namespace App\Services\CustomerService\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CustomerCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var Collection
     */
    public $collection = CustomerResource::class;
}
