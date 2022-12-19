<?php

namespace App\Services\TagService\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

/**
 * @param string $mediable_type
 * @param int $mediable_id
 * @param string $title
 * @param string $slug
 * @param bool $status
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'title',
        'slug',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * Implement One-to-Many Polymorphic relation.
     */
    public function taggable(): MorphTo
    {
        return $this->morphTo();
    }
}
