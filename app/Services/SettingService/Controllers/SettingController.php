<?php

namespace App\Services\SettingService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\ResponseService\Facades\Response;
use App\Services\SettingService\Requests\Admin\CreateSettingRequest;
use App\Services\SettingService\Requests\Admin\UpdateSettingRequest;
use App\Services\SettingService\Models\Setting;
use App\Services\SettingService\Repositories\SettingRepositoryInterface;
use App\Services\SettingService\Resources\SettingCollection;
use App\Services\SettingService\Resources\SettingResource;
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

        return Response::paginate(new SettingCollection($result));
    }

    /**
     * @param CreateSettingRequest $request
     * @return JsonResponse
     */
    public function store(CreateSettingRequest $request): JsonResponse
    {
        $result = $this->settingService->create($request->validated());

        return Response::created(new SettingResource($result));
    }

    /**
     * @param Setting $setting
     * @return JsonResponse
     */
    public function show(Setting $setting): JsonResponse
    {
        $result = $this->settingService->show($setting);

        return Response::retrieved(new SettingResource($result));
    }

    /**
     * @param UpdateSettingRequest $request
     * @param Setting $setting
     * @return JsonResponse
     */
    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $result = $this->settingService->update($setting, $request->validated());

        return Response::updated(new SettingResource($result));
    }

    /**
     * @param Setting $setting
     * @return JsonResponse
     */
    public function delete(Setting $setting): JsonResponse
    {
        $result = $this->settingService->destroy($setting);

        if ($result) {
            return Response::deleted(['result' => true]);
        }

        return Response::error(['result' => false]);
    }

    /**
     * Activate the setting record.
     *
     * @param Setting $setting
     * @return JsonResponse
     */
    public function activate(Setting $setting): JsonResponse
    {
        $result = $this->settingService->activate($setting);

        return Response::success(new SettingResource($result));
    }

    /**
     * Deactivate the setting record.
     *
     * @param Setting $setting
     * @return JsonResponse
     */
    public function deactivate(Setting $setting): JsonResponse
    {
        $result = $this->settingService->deactivate($setting);

        return Response::success(new SettingResource($result));
    }

    /** Panel methods */

    /**
     * Get settings by their type.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getPermanent(Request $request): JsonResponse
    {
        $permanentSettings = $this->settingService->getPermanent($request->query('type'));

        return Response::retrieved(new SettingCollection($permanentSettings));
    }

    /**
     * Get short list of settings.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getShortList(Request $request): JsonResponse
    {
        $permanentSettings = $this->settingService->getShortList($request->query('type'));

        return Response::make($permanentSettings->toArray(), [
            'type' => 'info',
            'text' => __('response::default.actions.retrieved')
        ]);
    }

    /**
     * Get an entire record by slug.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getBySlug(Request $request): JsonResponse
    {
        $result = $this->settingService->getBySlug($request->slug);

        if ($result) {
            return Response::retrieved(new SettingResource($result));
        }

        return Response::notFound();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getValueBySlug(Request $request): JsonResponse
    {
        $result = $this->settingService->getValueBySlug($request->slug);

        if ($result) {
            return Response::make(['result' => $result], [
                'type' => 'info',
                'text' => __('response::default.actions.retrieved')
            ]);
        }

        return Response::notFound();
    }
}
