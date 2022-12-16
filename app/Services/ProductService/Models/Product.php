<?php

namespace App\Services\ProductService\Models;

use App\Services\MediaService\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
}
