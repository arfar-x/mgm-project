<?php

namespace App\Services\AuthenticationService\Repositories;

use App\Services\AuthenticationService\Models\User;
use App\Services\BaseService\Repositories\BaseRepositoryInterface;

interface AuthenticationRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param array $parameters
     * @return array|bool
     */
    public function login(array $parameters): array|bool;

    /**
     * @param array $parameters
     * @return User|bool
     */
    public function register(array $parameters): User|bool;

    /**
     * @return bool
     */
    public function logout(): bool;

    /**
     * @return User|null
     */
    public function me(): User|null;

    /**
     * @param array $parameters
     * @return bool
     */
    public function changePassword(array $parameters): bool;
}