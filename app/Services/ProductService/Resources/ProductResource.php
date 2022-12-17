<?php

namespace App\Services\ProductService\Resources;

use App\Services\MediaService\Resources\MediaCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'cover' => $this->cover,
            'gallery' => $this->gallery,
            'status' => $this->status,
            'media' => new MediaCollection($this->mediable),
            'attributes' => new AttributeCollection($this->attributes),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}