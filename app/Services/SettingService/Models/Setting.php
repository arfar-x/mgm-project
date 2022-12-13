<?php

namespace App\Services\SettingService\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $value
 * @property string $type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Setting extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'value',
        'type',
        'status',
        'created_at',
        'updated_at',
    ];
}
