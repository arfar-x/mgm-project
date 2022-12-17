<?php

namespace App\Services\MediaService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\MediaService\Repositories\MediaRepositoryInterface;
use App\Services\MediaService\Requests\UploadFileRequest;
use App\Services\MediaService\Resources\MediaCollection;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends BaseController
{
    /**
     * @param MediaRepositoryInterface $mediaService
     */
    public function __construct(protected MediaRepositoryInterface $mediaService)
    {
        //
    }

    /**
     * Upload the file and store to storage.
     *
     * @return void
     */
    public function upload(UploadFileRequest $request): JsonResponse
    {
        $result = $this->mediaService->upload($request->file('files'), Arr::except($request->validated(), 'files'));

        return Response::success(new MediaCollection($result));
    }

    /**
     * Prepare the response for downloading the file.
     *
     * @return void
     */
    public function download(Request $request): BinaryFileResponse|JsonResponse
    {
        $filePath = $this->mediaService->getFilePath($request->type, $request->uuid);

        if ($filePath) {
            return response()->download($filePath);
        }

        return Response::notFound();
    }

    /**
     * Delete file by given UUID.
     *
     * @return JsonResponse
     */
    public function deleteFile(Request $request): JsonResponse
    {
        $result = $this->mediaService->deleteFile($request->uuid);

        if ($result) {
            return Response::deleted(['result' => $result]);
        } elseif (is_null($result)) {
            return Response::notFound();
        }

        return Response::error(['result' => $result]);
    }
}
