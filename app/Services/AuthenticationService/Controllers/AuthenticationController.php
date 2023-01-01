<?php

namespace App\Services\AuthenticationService\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Services\AuthenticationService\Models\User;
use App\Services\AuthenticationService\Repositories\AuthenticationRepositoryInterface;
use App\Services\AuthenticationService\Requests\ChangePasswordRequest;
use App\Services\AuthenticationService\Requests\LoginRequest;
use App\Services\AuthenticationService\Requests\RegisterRequest;
use App\Services\AuthenticationService\Requests\UpdateRequest;
use App\Services\AuthenticationService\Resources\UserResource;
use App\Services\ResponseService\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends BaseController
{
    /**
     * @param AuthenticationRepositoryInterface $authService
     */
    public function __construct(protected AuthenticationRepositoryInterface $authService)
    {
        //
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request->validated());

        if ($result) {
            return Response::success([
                'user' => new UserResource($result['user']),
                'token' => $result['token']
            ]);
        }

        return Response::error(['result' => false]);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return Response::created(new UserResource($result));
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $result = $this->authService->logout();

        return Response::success(['result' => $result]);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->authService->me();

        return Response::retrieved(new UserResource($user));
    }

    /**
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $result = $this->authService->update($user, $request->validated());

        return Response::success(new UserResource($result));
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $result = $this->authService->changePassword($request->validated());

        return Response::success(['result' => $result]);
    }
}
