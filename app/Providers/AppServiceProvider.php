<?php

namespace App\Providers;

use App\Services\MovieParser\Contracts\MovieParserInterface;
use App\Services\MovieParser\MovieParser;
use App\Services\MoviePoster\Contracts\MoviePosterService;
use App\Services\MoviePoster\MoviePoster;
use App\Utilities\HttpClient\Contracts\HttpClient;
use App\Utilities\HttpClient\CurlClient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\Users\User\UserRegister\Register;
use App\Services\Users\BlankUser\KeyGenerator\RandomGenerator;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\User\InputUpdateTransformer\UpdateDataTransformer;
use App\Services\Publications\Patents\Patent\StorageService\StorageService;
use App\Services\Publications\Services\PublicationStorage\PublicationStorage;
use App\Services\Publications\Services\PublicationService\PublicationService;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;
use App\Services\Publications\Patents\Patent\StorageService\Contracts\StorageServiceInterface;
use App\Services\Publications\Services\PublicationService\Contracts\PublicationServiceInterface;
use App\Services\Publications\Services\PublicationStorage\Contracts\PublicationStorageInterface;

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
        $this->app->bind(UserRegister::class, Register::class);
        $this->app->bind(KeyGenerator::class, RandomGenerator::class);
        $this->app->bind(DataTransformer::class, UpdateDataTransformer::class);
        $this->app->bind(StorageServiceInterface::class, StorageService::class);
        $this->app->bind(PublicationServiceInterface::class, PublicationService::class);
        $this->app->bind(PublicationStorageInterface::class, PublicationStorage::class);
        $this->app->bind(MovieParserInterface::class, MovieParser::class);
        $this->app->bind(HttpClient::class, CurlClient::class);
        $this->app->bind(MoviePosterService::class, MoviePoster::class);
    }
}
