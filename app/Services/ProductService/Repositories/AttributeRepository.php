<?php

namespace App\Services\ProductService\Repositories;

use App\Services\BaseService\Repositories\BaseRepository;
use App\Services\ProductService\Models\Attribute;
use App\Services\ProductService\Models\Product;
use Illuminate\Support\Collection;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    /**
     * @param Attribute $model
     */
    public function __construct(Attribute $model)
    {
        parent::__construct($model);
    }

    /**
     * Create product's attributes by relation.
     *
     * @param Product $product
     * @param array $attributes
     * @return Collection
     */
    public function setProductAttributes(Product $product, array $attributes): array
    {
        return $product->attributes()->createMany($attributes);
    }

    /**
     * Update product's attributes by relation.
     *
     * @param Product $product
     * @param array $attributes
     * @return void
     */
    public function updateProductAttributes(Product $product, array $attributes): void
    {
        dd($product->attributes()->delete());
        $attributeCollection = collect();

        foreach ($attributes as $attribute) {
            if ($product->attributes()->update($attribute)) {
                // $attributeCollection->push($attribute->)
            }
        }

        return ;
    }
}