<?php

namespace App\Providers;

use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\BlankUser\KeyGenerator\RandomGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(KeyGenerator::class, RandomGenerator::class);
    }
}
