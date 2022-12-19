<?php

namespace App\Services\ProjectService\Models;

use App\Services\MediaService\Models\Media;
use App\Services\TagService\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;

/**
 * @param int $category_id
 * @param string $title
 * @param string $slug
 * @param string $body
 * @param string $cover
 * @param string $gallery
 * @param bool $status
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'body',
        'cover',
        'gallery',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * @return MorphMany
     */
    public function mediable(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return MorphToMany
     */
    public function taggable(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
