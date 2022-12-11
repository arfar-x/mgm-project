<?php

namespace App\Services\SettingService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\SettingService\Models\Setting;
use App\Services\SettingService\Repositories\SettingRepositoryInterface;

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

    /**
     * Find exact record by given key-value.
     *
     * @param string $key
     * @param string $value
     * @return Setting|null
     */
    public function findBy(string $key, string $value): Setting|null
    {
        return $this->model->where($key, $value)->first();
    }
}