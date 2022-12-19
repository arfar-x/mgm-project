<?php

namespace App\Services\ProjectService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\MediaService\Repositories\MediaRepositoryInterface;
use App\Services\MediaService\Resources\MediaCollection;
use App\Services\ProjectService\Models\Project;
use App\Services\ProjectService\Repositories\ProjectRepositoryInterface;
use App\Services\ProjectService\Requests\ChangeProjectCategoryRequest;
use App\Services\ProjectService\Requests\CreateProjectRequest;
use App\Services\ProjectService\Requests\UpdateProjectRequest;
use App\Services\ProjectService\Requests\UploadProjectFileRequest;
use App\Services\ProjectService\Resources\ProjectCollection;
use App\Services\ProjectService\Resources\ProjectResource;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProjectController extends BaseController
{
    /**
     * @param ProjectRepositoryInterface $projectService
     * @param MediaRepositoryInterface $mediaService
     */
    public function __construct(
        protected ProjectRepositoryInterface $projectService,
        protected MediaRepositoryInterface $mediaService,
    ) {
        //
    }

    /** Admin methods */

    /**
     * @param CreateProjectRequest $request
     * @return JsonResponse
     */
    public function store(CreateProjectRequest $request): JsonResponse
    {
        $parameters = Arr::except($request->validated(), 'files');
        $files = $request->validated()['files'] ?? [];

        $project = $this->projectService->create($parameters);
        
        $files = $this->mediaService->upload($files, model: $project);

        if ($files->isNotEmpty()) {
            $this->projectService->setCoverUuid($project, $files->first()->uuid);
        }

        return Response::created(new ProjectResource($project));
    }

    /**
     * @param UpdateProjectRequest $request
     * @param Project $project
     * @return JsonResponse
     */
    public function update(UpdateProjectRequest $request, Project $project): JsonResponse
    {
        $parameters = Arr::except($request->validated(), 'files');

        $project = $this->projectService->update($project, $parameters);

        return Response::updated(new ProjectResource($project));
    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function destroy(Project $project): JsonResponse
    {
        $result = $this->projectService->destroy($project);

        if ($result) {
            return Response::deleted(['result' => $result]);
        }

        return Response::error(['result' => $result]);
    }

    /**
     * Activate the project record.
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function activate(Project $project): JsonResponse
    {
        $result = $this->projectService->activate($project);

        return Response::success(new ProjectResource($result));
    }

    /**
     * Deactivate the project record.
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function deactivate(Project $project): JsonResponse
    {
        $result = $this->projectService->deactivate($project);

        return Response::success(new ProjectResource($result));
    }

    /**
     * Upload file for a specific project and store to storage.
     *
     * @return JsonResponse
     */
    public function upload(UploadProjectFileRequest $request, Project $project): JsonResponse
    {
        $result = $this->mediaService->upload(
            $request->file('files'),
            Arr::except($request->validated(), 'files'),
            $project
        );

        return Response::success(new MediaCollection($result));
    }

    /**
     * Delete file for a specific project by given UUID.
     *
     * @return JsonResponse
     */
    public function deleteFile(Request $request, Project $project): JsonResponse
    {
        $result = $this->mediaService->deleteFile($request->uuid, $project);

        if ($result) {
            return Response::deleted(['result' => $result]);
        } elseif (is_null($result)) {
            return Response::notFound();
        }

        return Response::error(['result' => $result]);
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return 
     */
    public function setCover(Request $request, Project $project): JsonResponse
    {
        $result = $this->projectService->setCoverUuid($project, $request->uuid);

        return Response::success(new ProjectResource($result));
    }

    /**
     * @param Request $request
     * @param Project $project
     * @return JsonResponse
     */
    public function changeCategory(ChangeProjectCategoryRequest $request, Project $project): JsonResponse
    {
        $result = $this->projectService->changeCategory($project, $request->validated());

        if ($result) {
            return Response::success(['result' => $result]);
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
        $result = $this->projectService->list($request->query());

        return Response::paginate(new ProjectCollection($result));
    }

    /**
     * @param Project $project
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        $result = $this->projectService->show($project);

        return Response::retrieved(new ProjectResource($result));
    }
}
