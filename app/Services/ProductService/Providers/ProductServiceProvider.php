<?php

namespace App\Services\ProductService\Providers;

use App\Services\ProductService\Repositories\AttributeRepository;
use App\Services\ProductService\Repositories\AttributeRepositoryInterface;
use App\Services\ProductService\Repositories\CategoryRepository;
use App\Services\ProductService\Repositories\CategoryRepositoryInterface;
use App\Services\ProductService\Repositories\ProductRepository;
use App\Services\ProductService\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(AttributeRepositoryInterface::class, AttributeRepository::class);
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