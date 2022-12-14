<?php

namespace App\Services\AuthenticationService\Providers;

use App\Services\AuthenticationService\Repositories\AuthenticationRepository;
use App\Services\AuthenticationService\Repositories\AuthenticationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthenticationRepositoryInterface::class, AuthenticationRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}