<?php

namespace App\Services\ProductService\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected $table = 'product_categories';

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
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
