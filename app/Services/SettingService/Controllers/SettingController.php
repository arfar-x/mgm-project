<?php

namespace App\Services\SettingService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\SettingService\Requests\Admin\CreateSettingRequest;
use App\Services\SettingService\Requests\Admin\UpdateSettingRequest;
use App\Services\SettingService\Models\Setting;
use App\Services\SettingService\Repositories\SettingRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * @param SettingRepositoryInterface $settingService
     */
    public function __construct(protected SettingRepositoryInterface $settingService)
    {
        //
    }

    /** Admin methods */

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $result = $this->settingService->list($request->query());

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(CreateSettingRequest $request): JsonResponse
    {
        $result = $this->settingService->create($request->validated());

        return response()->json($result);
    }

    /**
     * @param Setting $setting
     * @return JsonResponse
     */
    public function show(Setting $setting): JsonResponse
    {
        $result = $this->settingService->show($setting);

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @param Setting $setting
     * @return JsonResponse
     */
    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $result = $this->settingService->update($setting, $request->validated());

        return response()->json($result);
    }

    /**
     * @param Setting $setting
     * @return JsonResponse
     */
    public function delete(Setting $setting): JsonResponse
    {
        $result = $this->settingService->destroy($setting);

        return response()->json($result);
    }

    /** Panel methods */

    /**
     * Get settings by their type.
     *
     * @param Request $request
     * @return void
     */
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