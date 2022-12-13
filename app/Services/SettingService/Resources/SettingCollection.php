<?php

namespace App\Services\SettingService\Resources;

use App\Services\SettingService\Resources\SettingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SettingCollection extends ResourceCollection
{
    /**
     * The mapped collection instance.
     *
     * @var \Illuminate\Support\Collection
     */
    public $collection = SettingResource::class;
}
