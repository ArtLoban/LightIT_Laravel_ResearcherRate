<?php

namespace App\Providers;

use App\Helpers\Hasher\Contracts\HasherInterface;
use App\Helpers\Hasher\HasherService;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HasherInterface::class, HasherService::class);
    }
}
