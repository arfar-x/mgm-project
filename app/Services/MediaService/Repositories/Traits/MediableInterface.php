<?php

namespace App\Services\MediaService\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface MediableInterface
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
     * Delete a linked file with the relation.
     *
     * @param Model $model
     * @param string $uuid
     * @return boolean
     */
    public function deleteFile(Model $model, string $uuid): bool;

    /**
     * Get the path of a file.
     * This is useful when /public directory is not linked to /storage.
     * 
     * @param Model $Media
     * @return Model
     */
    public function getFilePath(string $uuid): string;
}
