<?php

namespace App\Services\MediaService\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

/**
 * @param string $mediable_type
 * @param int $mediable_id
 * @param string $title
 * @param string $type
 * @param string $uuid
 * @param string $mime
 * @param string $size
 * @param string $meta
 * @param string $path
 * @param Carbon $created_at
 * @param Carbon $updated_at
 */
class Media extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The directory within /public in which model's media files are stored.
     *
     * @var string
     */
    public $mediaDirectory = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mediable_type', // Morph relation fields
        'mediable_id',   // Morph relation fields
        'title',
        'type',
        'uuid',
        'mime',
        'size',
        'meta',
        'path',
        'created_at',
        'updated_at'
    ];

    /**
     * Implement One-to-Many Polymorphic relation.
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
