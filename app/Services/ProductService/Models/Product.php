<?php

namespace App\Services\ProductService\Models;

use App\Services\MediaService\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;

/**
 * @param string $title
 * @param string $slug
 * @param string $body
 * @param string $cover
 * @param string $gallery
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'cover',
        'gallery',
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
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
