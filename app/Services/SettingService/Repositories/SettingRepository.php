<?php

namespace App\Services\SettingService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\SettingService\Models\Setting;
use App\Services\SettingService\Repositories\SettingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
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
     * @return void
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
     * @return void
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
     * @return Setting|null
     */
    public function getBySlug(string $slug): Setting|null
    {
        return $this->findBy('slug', $slug);
    }

    /**
     * Get value by given slug.
     *
     * @param string $slug
     * @return string
     */
    public function getValueBySlug(string $slug): string
    {
        /** @var string */
        return $this->findBy('slug', $slug)->value;
    }
}