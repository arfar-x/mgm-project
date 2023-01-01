<?php

namespace App\Services\AuthenticationService\Repositories;

use App\Services\AuthenticationService\Models\User;
use App\Services\BaseService\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationRepository extends BaseRepository implements AuthenticationRepositoryInterface
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $parameters
     * @return array|bool
     */
    public function login(array $parameters): array|bool
    {
        if (Auth::attempt($parameters)) {
            /** @var User $user */
            $user = Auth::user();

            return [
                'user' => $user,
                'token' => $user->createToken(env('APP_NAME'))->plainTextToken
            ];
        }

        return false;
    }

    /**
     * @param array $parameters
     * @return User|bool
     */
    public function register(array $parameters): User|bool
    {
        $parameters['username'] = $parameters['username'] ?? $parameters['mobile'];
        $parameters['password'] = Hash::make($parameters['password']);

        /** @var User */
        return $this->create($parameters);
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->currentAccessToken()->delete();
    }

    /**
     * @return User|null
     */
    public function me(): User|null
    {
        /** @var User */
        return Auth::user();
    }

    /**
     * @param array $parameters
     * @return bool
     */
    public function changePassword(array $parameters): bool
    {
        /** @var User $user */
        $user = Auth::user();

        if (
            Hash::check($parameters['old_password'], $user->password) &&
            !is_null($parameters['password']) &&
            trim($parameters['password']) != ''
        ) {
            $parameters['password'] = Hash::make(trim($parameters['password']));
        } else {
            unset($parameters['password']);
        }

        return $user->update($parameters);
    }
}
