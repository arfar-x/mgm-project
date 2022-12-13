<?php

namespace App\Services\ResponseService\Facades;

use Illuminate\Support\Facades\Facade;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * @method static JsonResponse make(JsonResource|array $data, array $messages, int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse success($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = [])
 * @method static JsonResponse retrieved($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = [])
 * @method static JsonResponse paginate($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = [])
 * @method static JsonResponse info($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = [])
 * @method static JsonResponse created($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_CREATED, $meta = [])
 * @method static JsonResponse updated($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = [])
 * @method static JsonResponse deleted($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, $meta = [])
 * @method static JsonResponse noContent($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_NO_CONTENT, $meta = [])
 * @method static JsonResponse unauthorized($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_UNAUTHORIZED, $meta = [])
 * @method static JsonResponse error($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR, $meta = [])
 * @method static JsonResponse notFound($data = [], $messages = [], int $statusCode = SymfonyResponse::HTTP_NOT_FOUND, $meta = [])
 *
 * @see \App\Services\ResponseService\Response
 */
class Response extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor(): string
    {
        return 'response';
    }
}