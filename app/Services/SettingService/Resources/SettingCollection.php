<?php

namespace App\Services\SettingService\Resources;

use App\Services\SettingService\Resources\SettingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class SettingCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var Collection
     */
    public $collection = SettingResource::class;
}
