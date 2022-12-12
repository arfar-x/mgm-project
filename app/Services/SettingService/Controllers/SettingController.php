<?php

namespace App\Services\SettingService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\SettingService\Repositories\SettingRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function __construct(protected SettingRepositoryInterface $settingService)
    {
        //
    }

    public function getPermanent(Request $request)
    {
        $permanentSettings = $this->settingService->getPermanent($request->query('type'));

        return response()->json(['result' => $permanentSettings]);
    }

    /**
     * Get an entire record by slug.
     *
     * @return JsonResponse
     */
    public function getBySlug(Request $request): JsonResponse
    {
        $result = $this->settingService->getBySlug($request->slug);

        return response()->json(['result' => $result]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getValueBySlug(Request $request): JsonResponse
    {
        $result = $this->settingService->getValueBySlug($request->slug);

        return response()->json(['result' => $result]);
    }
}