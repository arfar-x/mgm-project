<?php

namespace App\Services\ProjectService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\MediaService\Repositories\MediaRepositoryInterface;
use App\Services\MediaService\Requests\UploadFileRequest;
use App\Services\MediaService\Resources\MediaCollection;
use App\Services\ProjectService\Models\Category;
use App\Services\ProjectService\Repositories\CategoryRepositoryInterface;
use App\Services\ProjectService\Repositories\ProjectRepositoryInterface;
use App\Services\ProjectService\Requests\CreateCategoryRequest;
use App\Services\ProjectService\Requests\SetCoverRequest;
use App\Services\ProjectService\Requests\UpdateCategoryRequest;
use App\Services\ProjectService\Resources\CategoryCollection;
use App\Services\ProjectService\Resources\CategoryResource;
use App\Services\ProjectService\Resources\ProjectCollection;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CategoryController extends BaseController
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param ProjectRepositoryInterface $projectService
     * @param MediaRepositoryInterface $mediaService
     */
    public function __construct(
        protected CategoryRepositoryInterface $categoryRepository,
        protected ProjectRepositoryInterface $projectService,
        protected MediaRepositoryInterface $mediaService
    ) {
        //
    }

    /** Admin methods */

    /**
     * @param CreateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $parameters = Arr::except($request->validated(), 'files');
        $files = $request->validated()['files'] ?? [];

        /** @var Category $category */
        $category = $this->categoryRepository->create($parameters);

        $files = $this->mediaService->upload($files, model: $category);

        if ($files->isNotEmpty()) {
            $this->categoryRepository->setCoverUuid($category, $files->first()->uuid);
        }

        return Response::created(new CategoryResource($category));
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $parameters = Arr::except($request->validated(), ['files', 'attributes']);

        $category = $this->categoryRepository->update($category, $parameters);

        return Response::updated(new CategoryResource($category));
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Category $category): JsonResponse
    {
        $result = $this->categoryRepository->destroy($category);

        if ($result) {
            return Response::deleted(['result' => true]);
        }

        return Response::error(['result' => false]);
    }

    /**
     * Activate the product record.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function activate(Category $category): JsonResponse
    {
        $result = $this->categoryRepository->activate($category);

        return Response::success(new CategoryResource($result));
    }

    /**
     * Deactivate the product record.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function deactivate(Category $category): JsonResponse
    {
        $result = $this->categoryRepository->deactivate($category);

        return Response::success(new CategoryResource($result));
    }

    /**
     * Upload file for a specific product and store to storage.
     *
     * @param UploadFileRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function upload(UploadFileRequest $request, Category $category): JsonResponse
    {
        $file = $this->mediaService->upload(
            $request->file('files'),
            Arr::except($request->validated(), 'files'),
            $category
        );

        $this->categoryRepository->setCoverUuid($category, $file->first()->uuid->toString());

        return Response::success(new MediaCollection($file));
    }

    /**
     * Delete file for a specific product by given UUID.
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function deleteFile(Request $request, Category $category): JsonResponse
    {
        $result = $this->mediaService->deleteFile($request->uuid ?? $request->input('uuid'), $category);

        if ($result) {

            // Set category cover to null
            $this->categoryRepository->setCoverUuid($category);

            return Response::deleted(['result' => $result]);

        } elseif (is_null($result)) {
            return Response::notFound();
        }

        return Response::error(['result' => $result]);
    }

    /**
     * @param SetCoverRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function setCover(SetCoverRequest $request, Category $category): JsonResponse
    {
        $result = $this->categoryRepository->setCoverUuid($category, $request->input('uuid'));

        return Response::success(new CategoryResource($result));
    }

    /** General (Panel & Admin) methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->categoryRepository->list($request->query());

        return Response::paginate(new CategoryCollection($result));
    }

    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        $result = $this->categoryRepository->show($category);

        return Response::retrieved(new CategoryResource($result));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function getProjects(Request $request, Category $category): JsonResponse
    {
        $products = $this->projectService->getProjectsByCategory($category, $request->query());

        return Response::paginate(new ProjectCollection($products));
    }
}
