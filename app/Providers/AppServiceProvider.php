<?php

namespace App\Providers;

use App\Services\Publications\Article\ArticleStorageService\ArticleStorageService;
use App\Services\Publications\Article\ArticleStorageService\Contracts\ArticleStorageService as ArticleStorageServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\Users\User\UserRegister\Register;
use App\Services\Users\BlankUser\KeyGenerator\RandomGenerator;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\User\InputUpdateTransformer\UpdateDataTransformer;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });
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
        $this->app->bind(ArticleStorageServiceInterface::class, ArticleStorageService::class);
    }
}
