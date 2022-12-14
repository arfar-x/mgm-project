<?php

namespace App\Services\AuthenticationService\Controllers;

use App\Services\AuthenticationService\Repositories\AuthenticationRepositoryInterface;
use App\Services\AuthenticationService\Requests\ChangePasswordRequest;
use App\Services\AuthenticationService\Requests\LoginRequest;
use App\Services\AuthenticationService\Requests\RegisterRequest;
use App\Services\AuthenticationService\Requests\UpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController
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

        return response()->json($result);
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        return response()->json($result);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $result = $this->authService->logout();

        return response()->json($result);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $result = $this->authService->me();

        return response()->json($result);
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

        return response()->json($result);
    }

    /**
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $result = $this->authService->changePassword($request->validated());

        return response()->json($result);
    }
}