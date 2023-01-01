<?php

namespace App\Services\ProjectService\Resources;

use App\Services\MediaService\Resources\MediaCollection;
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
 * @property string $position
 * @property string $cover
 * @property bool $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Collection $mediable
 */
class CategoryResource extends JsonResource
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
            'position' => $this->position,
            'cover' => $this->cover,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'media' => new MediaCollection($this->mediable)
        ];
    }
}
