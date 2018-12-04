<?php

namespace App\Providers;

use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\BlankUser\KeyGenerator\RandomGenerator;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;
use App\Services\Users\User\InputUpdateTransformer\UpdateDataTransformer;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Users\User\UserRegister\Register;
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
        $this->app->bind(UserRegister::class, Register::class);
        $this->app->bind(DataTransformer::class, UpdateDataTransformer::class);
    }
}
