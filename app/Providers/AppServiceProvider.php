<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\Users\User\UserRegister\Register;
use App\Services\Users\BlankUser\KeyGenerator\RandomGenerator;
use App\Services\Publications\Article\StoreHandler\StoreHandler;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\User\InputUpdateTransformer\UpdateDataTransformer;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;
use App\Services\Publications\Article\StoreHandler\Contracts\StoreHandlerInterface;
use App\Services\Publications\Article\StoreHandler\Utilities\JournalHandler\JournalHandler;
use App\Services\Publications\Article\StoreHandler\Utilities\AuthorsHandler\AuthorsHandler;
use App\Services\Publications\Article\StoreHandler\Utilities\JournalHandler\Interfaces\JournalHandler as JournalHandlerInterfaces;
use App\Services\Publications\Article\StoreHandler\Utilities\AuthorsHandler\Interfaces\AuthorsHandler as AuthorsHandlerInterfaces;

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
        $this->app->bind(StoreHandlerInterface::class, StoreHandler::class);
        $this->app->bind(JournalHandlerInterfaces::class, JournalHandler::class);
        $this->app->bind(AuthorsHandlerInterfaces::class, AuthorsHandler::class);
    }
}
