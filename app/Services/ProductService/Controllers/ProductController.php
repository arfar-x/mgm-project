<?php

namespace App\Services\ProductService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\MediaService\Resources\MediaCollection;
use App\Services\ProductService\Models\Product;
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
     */
    public function __construct(protected ProductRepositoryInterface $productService)
    {
        //
    }

    /** Admin methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $result = $this->productService->create($request->validated());

        return Response::created(new ProductResource($result));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $result = $this->productService->update($product, $request->validated());

        return Response::updated(new ProductResource($result));
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
        $result = $this->productService->upload(
            $request->file('files'),
            Arr::except($request->validated(), 'files'),
            $product
        );

        return Response::success(new MediaCollection($result));
    }

    /**
     * Upload file for a specific product and store to storage.
     *
     * @return JsonResponse
     */
    public function deleteFile(Request $request, Product $product): JsonResponse
    {
        $result = $this->productService->deleteFile($product, $request->uuid);

        if ($result) {
            return Response::deleted(['result' => $result]);
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
