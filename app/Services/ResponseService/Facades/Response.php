<?php

namespace App\Services\ResponseService\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse make($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse success($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse retrieved($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse paginate($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse info($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse created($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse noContent($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse unauthorized($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse error($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
 * @method static JsonResponse notFound($data = [], $messages = [], int $statusCode = ResponseClass::HTTP_OK, $meta = [])
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