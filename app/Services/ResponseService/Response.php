<?php

namespace App\Services\ResponseService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Response as LaravelResponse;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Response
{
    /**
     * Make the response body.
     *
     * @param JsonResource $data
     * @param array $messages
     * @param integer $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function make(JsonResource|array $data, array $messages, int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
    {
        return LaravelResponse::json(
            [
                'messages' => $messages,
                'data' => $data,
                'meta' => $meta,
            ],
            $statusCode
        );
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function success(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'success',
                'text' => $messages ?: __('response::default.actions.success')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function retrieved(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'info',
                'text' => $messages ?: __('response::default.actions.retrieved')
            ];
        }
        
        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * Prepare response for paginated datas.
     * 
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function paginate(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = []): JsonResponse
    {
        if ($data instanceof ResourceCollection) {
            $meta = Arr::except($data->resource->toArray(), 'data');
            $data = $data->resource->toArray()['data'];
        }

        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'success',
                'text' => $messages ?: __('response::default.actions.retrieved')
            ];
        }
        
        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function info(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'info',
                'text' => $messages ?: __('response::default.actions.info')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function created(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_CREATED, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'success',
                'text' => $messages ?: __('response::default.actions.created')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource|array $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function updated(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'success',
                'text' => $messages ?: __('response::default.actions.updated')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource|array $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function deleted(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'success',
                'text' => $messages ?: __('response::default.actions.deleted')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function noContent(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_NO_CONTENT, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'info',
                'text' => $messages ?: __('response::default.actions.no-content')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function unauthorized(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_UNAUTHORIZED, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'error',
                'text' => $messages ?: __('response::default.actions.unauthorized')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function error(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'error',
                'text' => $messages ?: __('response::default.actions.error')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }

    /**
     * @param JsonResource $data
     * @param array $messages
     * @param int $statusCode
     * @param array $meta
     * @return JsonResponse
     */
    public function notFound(JsonResource|array $data, string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_NOT_FOUND, $meta = []): JsonResponse
    {
        if (is_string($messages) || empty($messages)) {
            $messages = [
                'type' => 'error',
                'text' => $messages ?: __('response::default.actions.not-found')
            ];
        }

        return $this->make($data, $messages, $statusCode, $meta);
    }
}