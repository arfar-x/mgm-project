<?php

namespace App\Http\Resources;

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

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
