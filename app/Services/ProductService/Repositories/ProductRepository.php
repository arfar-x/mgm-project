<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\MediaService\Repositories\Traits\Mediable;
use App\Services\ProductService\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use Mediable;

    /**
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);

        $this->initMediable($model);
    }

    /**
     * Create new product record then save its files via polymorphic relation.
     * 
     * @param array $parameters
     * @return Model
     */
    public function create(array $parameters): Model
    {
        $files = $parameters['files'] ?? [];
        $parameters = Arr::except($parameters, 'files');

        $product = $this->model->query()
            ->create($parameters);

        $files = $this->upload($files, model: $product);

        $product->update([
            'cover' => $files->first()->uuid
        ]);

        return $product;
    }

    // public function deleteFile(Product $product, string $uuid): Product
    // {
    //     return $product->mediable()->where('uuid', $uuid)->delete();
    // }
}
