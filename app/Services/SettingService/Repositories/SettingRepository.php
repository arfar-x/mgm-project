<?php

namespace App\Services\SettingService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\SettingService\Models\Setting;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    /**
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * Get settings by their type.
     *
     * @param string|array|null $types
     * @return EloquentCollection
     */
    public function getPermanent(string|array $types = null): EloquentCollection
    {
        $types = empty($types) ? [
            'info',
            'slogan',
            'copyright'
        ] : $types;

        return $this->findIn('type', $types)->get();
    }

    /**
     * Get settings' slugs by their type.
     *
     * @param string|array|null $types
     * @return Collection
     */
    public function getShortList(string|array $types = null): Collection
    {
        $types = empty($types) ? [
            'info',
            'slogan',
            'copyright'
        ] : $types;

        return $this->findIn('type', $types)->pluck('value', 'slug');
    }

    /**
     * Get a setting record by slug.
     *
     * @param string $slug
     * @return Setting|Model|null
     */
    public function getBySlug(string $slug): Setting|Model|null
    {
        return $this->findBy('slug', $slug);
    }

    /**
     * Get value by given slug.
     *
     * @param string $slug
     * @return string|null
     */
    public function getValueBySlug(string $slug): string|null
    {
        /** @var string */
        return $this->findBy('slug', $slug)?->value;
    }
}
