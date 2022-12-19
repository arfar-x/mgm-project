<?php

namespace App\Services\BaseService\Providers;

use App\Services\AuthenticationService\Providers\AuthenticationServiceProvider;
use App\Services\ContactService\Providers\ContactServiceProvider;
use App\Services\MediaService\Providers\MediaServiceProvider;
use App\Services\ProductService\Providers\ProductServiceProvider;
use App\Services\ProjectService\Providers\ProjectServiceProvider;
use App\Services\ResponseService\Providers\ResponseServiceProvider;
use App\Services\SettingService\Providers\SettingServiceProvider;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(SettingServiceProvider::class);
        $this->app->register(ResponseServiceProvider::class);
        $this->app->register(AuthenticationServiceProvider::class);
        $this->app->register(ContactServiceProvider::class);
        $this->app->register(ProductServiceProvider::class);
        $this->app->register(MediaServiceProvider::class);
        $this->app->register(ProjectServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
