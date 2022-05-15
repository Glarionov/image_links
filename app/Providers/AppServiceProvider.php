<?php

namespace App\Providers;

use App\Interfaces\Image\ImageServiceInterface;
use App\Interfaces\Link\LinkServiceInterface;
use App\Models\Link;
use App\Services\Image\ImageServiceService;
use App\Services\Link\LinkServiceService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinkServiceInterface::class, LinkServiceService::class);
        $this->app->bind(ImageServiceInterface::class, ImageServiceService::class);
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
