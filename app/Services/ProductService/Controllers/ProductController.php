<?php

namespace App\Services\ProductService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\MediaService\Repositories\MediaRepositoryInterface;
use App\Services\MediaService\Resources\MediaCollection;
use App\Services\ProductService\Models\Product;
use App\Services\ProductService\Repositories\AttributeRepositoryInterface;
use App\Services\ProductService\Repositories\ProductRepositoryInterface;
use App\Services\ProductService\Requests\CreateProductRequest;
use App\Services\ProductService\Requests\UpdateProductRequest;
use App\Services\ProductService\Requests\UploadProductFileRequest;
use App\Services\ProductService\Resources\ProductCollection;
use App\Services\ProductService\Resources\ProductResource;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends BaseController
{
    /**
     * @param ProductRepositoryInterface $productService
     * @param MediaRepositoryInterface $mediaService
     */
    public function __construct(
        protected ProductRepositoryInterface $productService,
        protected MediaRepositoryInterface $mediaService,
        protected AttributeRepositoryInterface $attributeRepository
    ) {
        //
    }

    /** Admin methods */

    /**
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $parameters = Arr::except($request->validated(), 'files');
        $files = $request->validated()['files'] ?? [];

        $product = $this->productService->create($parameters);
        
        $files = $this->mediaService->upload($files, model: $product);

        if ($files->isNotEmpty()) {
            $this->productService->setCoverUuid($product, $files->first()->uuid);
        }

        if ($request->has('attributes')) {
            $this->attributeRepository->setProductAttributes($product, $request->input('attributes'));
        }

        return Response::created(new ProductResource($product));
    }

    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $parameters = Arr::except($request->validated(), ['files', 'attributes']);

        $product = $this->productService->update($product, $parameters);

        if ($request->has('attributes')) {
            $this->attributeRepository->updateProductAttributes($product, $request->input('attributes'));
        }

        return Response::updated(new ProductResource($product));
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function delete(Product $product): JsonResponse
    {
        $result = $this->productService->destroy($product);

        if ($result) {
            return Response::deleted(['result' => $result]);
        }

        return Response::error(['result' => $result]);
    }

    /**
     * Activate the product record.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function activate(Product $product): JsonResponse
    {
        $result = $this->productService->activate($product);

        return Response::success(new ProductResource($result));
    }

    /**
     * Deactivate the product record.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function deactivate(Product $product): JsonResponse
    {
        $result = $this->productService->deactivate($product);

        return Response::success(new ProductResource($result));
    }

    /**
     * Upload file for a specific product and store to storage.
     *
     * @return JsonResponse
     */
    public function upload(UploadProductFileRequest $request, Product $product): JsonResponse
    {
        $result = $this->mediaService->upload(
            $request->file('files'),
            Arr::except($request->validated(), 'files'),
            $product
        );

        return Response::success(new MediaCollection($result));
    }

    /**
     * Delete file for a specific product by given UUID.
     *
     * @return JsonResponse
     */
    public function deleteFile(Request $request, Product $product): JsonResponse
    {
        $result = $this->mediaService->deleteFile($request->uuid, $product);

        if ($result) {
            return Response::deleted(['result' => $result]);
        } elseif (is_null($result)) {
            return Response::notFound();
        }

        return Response::error(['result' => $result]);
    }

    /** General (Panel & Admin) methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->productService->list($request->query());

        return Response::paginate(new ProductCollection($result));
    }

    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        $result = $this->productService->show($product);

        return Response::retrieved(new ProductResource($result));
    }
}
