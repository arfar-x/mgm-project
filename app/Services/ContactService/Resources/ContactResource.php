<?php

namespace App\Services\ContactService\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * @property int $id
 * @property string $caption
 * @property string $sender_name
 * @property string $sender_mobile
 * @property string $sender_email
 * @property string $body
 * @property string $channel
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ContactResource extends JsonResource
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
            'caption' => $this->caption,
            'sender_name' => $this->sender_name,
            'sender_mobile' => $this->sender_mobile,
            'sender_email' => $this->sender_email,
            'body' => $this->body,
            'channel' => $this->channel,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
