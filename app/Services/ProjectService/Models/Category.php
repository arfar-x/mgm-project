<?php

namespace App\Services\ProjectService\Models;

use App\Services\MediaService\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * @param string $title
 * @param string $slug
 * @param string $position
 * @param string $cover
 * @param string $status
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'position',
        'cover',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return MorphOne
     */
    public function mediable(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
