<?php

namespace App\Services\MediaService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\MediaService\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class MediaRepository extends BaseRepository implements MediaRepositoryInterface
{
    /**
     * @param Media $model
     */
    public function __construct(Media $model)
    {
        parent::__construct($model);
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
        $mediaModel = $model ? $model->mediable() : $this->model;

        $models = collect();

        foreach ($files as $file) {

            $uuid = Uuid::uuid1();
            $mime = $file->getClientOriginalExtension();
            $fileName = "$uuid.$mime";
            $path = $this->getPublicMediaPath($mediaModel);

            $media = $mediaModel->create([
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
     * Delete a linked file with the relation and delete from storage.
     *
     * @param string $uuid
     * @param Model $model
     * @return boolean|null
     */
    public function deleteFile(string $uuid, Model $model = null): bool|null
    {
        $mediaModel = $model ? $model->mediable() : $this->model;

        $file = $mediaModel->where('uuid', $uuid)->first();

        if ($file) {
            File::delete("$file->path/$uuid.$file->mime");
            
            if ($model instanceof Relation) {
                return $mediaModel->detach();
            } else {
                return $file->delete();
            }

        }

        return null;
    }

    /**
     * Delete all files of a model.
     *
     * @param Model|null $model
     * @return bool
     */
    public function deleteAllFiles(Model $model = null): bool
    {
        $mediaModel = $model ? $model->mediable() : $this->model;

        $files = collect();
        foreach ($mediaModel->get() as $file) {
            $files->push("$file->path/$file->uuid.$file->mime");
        }
        File::delete($files->toArray());

        if ($model instanceof Relation) {
            return $mediaModel->detach();
        } else {
            return $mediaModel->delete();
        }
    }

    /**
     * Get the path of a file.
     * This is useful when /public directory is not linked to /storage.
     * 
     * @param string $type
     * @param string $uuid
     * @return string|null
     */
    public function getFilePath(string $type, string $uuid): string|null
    {
        $file = $this->model->where('uuid', $uuid)->first();
        
        if ($file) {
            $fileName = "{$file->uuid}.{$file->mime}";

            return storage_path("app/public/$type") . "/$fileName";
        }

        return null;
    }

    /**
     * Get the path in public in which media files are stores.
     * 
     * @return string
     */
    private function getPublicMediaPath(Model|Relation $model): string
    {
        return public_path('storage/' . $this->getModelMediaDirectory($model));
    }

    /**
     * The directory of model type in which media files are stored.
     * If model has $mediaDirectory inside, then it will be used,
     * If not, model name will be used instead.
     * 
     * @return string
     */
    private function getModelMediaDirectory(Model|Relation $model): string
    {
        if ($model instanceof Relation) {
            $model = $model->getMorphClass();
        }

        return strtolower(class_basename($model));
    }
}