<?php

namespace App\Services\MediaService\Repositories;

use App\Services\BaseService\Repositories\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

Interface MediaRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Create a record into database for every single uploaded file
     * and move them to a proper directory.
     * 
     * @param array $parameters
     * @return Model
     */
    public function upload(array $files, array $parameters = [], Model $model = null): Collection;

    /**
     * Delete a linked file with the relation and delete from storage.
     *
     * @param Model $model
     * @param string $uuid
     * @return bool|null
     */
    public function deleteFile(string $uuid, Model $model = null): bool|null;

    /**
     * Delete all files of a model.
     *
     * @param Model|null $model
     * @return bool
     */
    public function deleteAllFiles(Model $model = null): bool;

    /**
     * Get the path of a file.
     * This is useful when /public directory is not linked to /storage.
     * 
     * @param string $type
     * @param string $uuid
     * @return string|null
     */
    public function getFilePath(string $type, string $uuid): string|null;
}