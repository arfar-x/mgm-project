<?php

namespace App\Services\SettingService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\SettingService\Models\Setting;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get a setting record by slug.
     *
     * @param string $slug
     * @return Setting|null
     */
    public function getBySlug(string $slug): Setting|null;

    /**
     * Get value by given slug.
     *
     * @param string $slug
     * @return string
     */
    public function getValueBySlug(string $slug): string;

    /**
     * Find exact record by given key-value.
     *
     * @param string $key
     * @param string $value
     * @return Setting|null
     */
    public function findBy(string $key, string $value): Setting|null;
}