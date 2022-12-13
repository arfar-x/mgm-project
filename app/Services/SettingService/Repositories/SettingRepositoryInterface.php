<?php

namespace App\Services\SettingService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use App\Services\SettingService\Models\Setting;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface SettingRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get settings by their type.
     *
     * @return 
     */
    public function getPermanent(string|array $types = null): EloquentCollection;

    /**
     * Get settings' slugs by their type.
     *
     * @return 
     */
    public function getShortList(string|array $types = null): Collection;

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
    public function getValueBySlug(string $slug): string|null;
}