<?php

namespace App\Services\ResponseService\Facades;

use Illuminate\Support\Facades\Facade;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

/**
 * @method static JsonResponse make(JsonResource|array $data = [], array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse success(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse retrieved(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse paginate(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse info(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse created(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_CREATED, array $meta = [])
 * @method static JsonResponse updated(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse deleted(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_OK, array $meta = [])
 * @method static JsonResponse noContent(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_NO_CONTENT, array $meta = [])
 * @method static JsonResponse unauthorized(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_UNAUTHORIZED, array $meta = [])
 * @method static JsonResponse error(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR, array $meta = [])
 * @method static JsonResponse notFound(JsonResource|array $data = [], string|array $messages = [], int $statusCode = SymfonyResponse::HTTP_NOT_FOUND, array $meta = [])
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