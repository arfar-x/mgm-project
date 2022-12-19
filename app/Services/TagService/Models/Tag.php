<?php

namespace App\Services\TagService\Models;

use App\Services\ProductService\Models\Product;
use App\Services\ProjectService\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Carbon;

/**
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
        'title',
        'slug',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * Implement One-to-Many Polymorphic relation.
     * 
     * @return MorphToMany
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    /**
     * Implement One-to-Many Polymorphic relation.
     * 
     * @return MorphToMany
     */
    public function projects(): MorphToMany
    {
        return $this->morphedByMany(Project::class, 'taggable');
    }
}
