<?php

namespace App\Services\MediaService\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Ramsey\Uuid\Uuid;

trait Mediable
{
    /**
     * Media model with one-to-many polymorphic reltion.
     *
     * @var Model
     */
    protected Model|Relation $mediaModel;

    /**
     * Initialize mediable model instance to create the relative model.
     * If there is no relation with media model, then a media model will
     * be created.
     *
     * @param Model $model
     */
    public function initMediable(Model $model)
    {
        $this->mediaModel = $model->has('mediable') ? $model->mediable() : $model;
    }
    
    /**
     * Create a record into database for every single uploaded file
     * and move them to a proper directory.
     * 
     * @param array $parameters
     * @return Model
     */
    public function upload(array $files, array $parameters = [], Model $model = null): Collection
    {
        $this->mediaModel = $model ? $model->mediable() : $this->mediaModel;

        $models = collect();

        foreach ($files as $file) {

            $uuid = Uuid::uuid1();
            $mime = $file->getClientOriginalExtension();
            $fileName = "$uuid.$mime";
            $path = $this->getPublicMediaPath(); // ? Do I need it ?

            $media = $this->mediaModel->create([
                'title' => $parameters['title'] ?? $file->getClientOriginalName(),
                'type' => $parameters['type'] ?? null,
                'uuid' => $uuid,
                'mime' => $mime,
                'size' => $file->getSize(),
                'meta' => $parameters['meta'] ?? null,
                'path' => $path
            ]);

            $file->move($path, $fileName);

            $models->push($media);
        }

        return $models;
    }

    /**
     * Delete a linked file with the relation.
     *
     * @param Model $model
     * @param string $uuid
     * @return boolean
     */
    public function deleteFile(Model $model, string $uuid): bool
    {
        $this->mediaModel = $model ? $model->mediable() : $this->mediaModel;

        return $this->mediaModel->where('uuid', $uuid)->delete();
    }

    /**
     * Get the path of a file.
     * This is useful when /public directory is not linked to /storage.
     * 
     * @param string $uuid
     * @return Model
     */
    public function getFilePath(string $uuid): string
    {
        $file = $this->model->where('uuid', $uuid)->first();

        return $this->getStorageMediaPath() . "/{$file->uuid}.{$file->mime}";
    }

    /**
     * Get the path in public in which media files are stores.
     * 
     * @return string
     */
    private function getPublicMediaPath(): string
    {
        return public_path('storage/' . $this->getModelMediaDirectory());
    }

    /**
     * Get the path relative to storage directory.
     *
     * @return string
     */
    private function getStorageMediaPath(): string
    {
        return storage_path('app/public/' . $this->getModelMediaDirectory());
    }

    /**
     * The directory of model type in which media files are stored.
     * If model has $mediaDirectory inside, then it will be used,
     * If not, model name will be used instead.
     * 
     * @return string
     */
    private function getModelMediaDirectory(): string
    {
        return $this->model->mediaDirectory ?? strtolower(class_basename($this->model));
    }
}
