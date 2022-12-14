<?php

namespace App\Services\ContactService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @param int $id
 * @param string $caption
 * @param string $sender_name
 * @param string $sender_mobile
 * @param string $sender_email
 * @param string $body
 * @param string $channel
 * @param string $type
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'caption',
        'sender_name',
        'sender_mobile',
        'sender_email',
        'body',
        'channel',
        'type',
        'created_at',
        'updated_at'
    ];
}
