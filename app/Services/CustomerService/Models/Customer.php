<?php

namespace App\Services\CustomerService\Models;

use App\Services\MediaService\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Carbon;

/**
 * @param int $id
 * @param string $name
 * @param string $url
 * @param string $avatar
 * @param bool $is_featured
 * @param bool $status
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'avatar',
        'is_featured',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * @return MorphOne
     */
    public function mediable(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
