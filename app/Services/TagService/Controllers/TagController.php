<?php

namespace App\Services\TagService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\ResponseService\Facades\Response;
use App\Services\TagService\Models\Tag;
use App\Services\TagService\Repositories\TagRepositoryInterface;
use App\Services\TagService\Requests\CreateTagRequest;
use App\Services\TagService\Requests\UpdateTagRequest;
use App\Services\TagService\Resources\TagCollection;
use App\Services\TagService\Resources\TagResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    /**
     * @param TagRepositoryInterface $tagService
     */
    public function __construct(protected TagRepositoryInterface $tagService)
    {
        //
    }

    /** Admin methods */

    /**
     * Store a new contact record.
     *
     * @param CreateTagRequest $request
     * @return JsonResponse
     */
    public function store(CreateTagRequest $request): JsonResponse
    {
        $result = $this->tagService->create($request->validated());

        return Response::created(new TagResource($result));
    }

    /**
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function update(UpdateTagRequest $request, Tag $tag): JsonResponse
    {
        $result = $this->tagService->update($tag, $request->validated());

        return Response::updated(new TagResource($result));
    }

    /**
     * @param Tag $tag
     * @return JsonResponse
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $result = $this->tagService->destroy($tag);

        if ($result) {
            return Response::deleted(['result' => true]);
        }

        return Response::error(['result' => false]);
    }

    /**
     * Activate the customer record.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function activate(Tag $tag): JsonResponse
    {
        $result = $this->tagService->activate($tag);

        return Response::success(new TagResource($result));
    }

    /**
     * Deactivate the customer record.
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function deactivate(Tag $tag): JsonResponse
    {
        $result = $this->tagService->deactivate($tag);

        return Response::success(new TagResource($result));
    }

    /** Panel & Admin methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->tagService->list($request->query());

        return Response::paginate(new TagCollection($result));
    }

    /**
     * @param Tag $tag
     * @return JsonResponse
     */
    public function show(Tag $tag): JsonResponse
    {
        $result = $this->tagService->show($tag);

        return Response::retrieved(new TagResource($result));
    }
}
