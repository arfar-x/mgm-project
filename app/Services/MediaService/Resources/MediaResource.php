<?php

namespace App\Services\MediaService\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $uuid
 * @property string $mime
 * @property int $size
 * @property string $meta
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MediaResource extends JsonResource
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
            'type' => $this->type,
            'uuid' => $this->uuid,
            'mime' => $this->mime,
            'size' => $this->size,
            'meta' => $this->meta,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
