<?php

namespace App\Services\ProductService\Resources;

use App\Services\MediaService\Resources\MediaCollection;
use App\Services\TagService\Resources\TagCollection;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string $cover
 * @property string $gallery
 * @property bool $status
 * @property Collection $mediable
 * @property Collection $taggable
 * @property Collection $attributes
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
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
            'tags' => new TagCollection($this->taggable),
            'attributes' => new AttributeCollection($this->attributes),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
