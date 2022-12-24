<?php

namespace App\Services\ProjectService\Providers;

use App\Services\ProjectService\Repositories\CategoryRepository;
use App\Services\ProjectService\Repositories\CategoryRepositoryInterface;
use App\Services\ProjectService\Repositories\ProjectRepository;
use App\Services\ProjectService\Repositories\ProjectRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
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
