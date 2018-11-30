<?php

namespace App\Providers;

use App\Services\Publications\Patent\StorageService\Contracts\StorageServiceInterface;
use App\Services\Publications\Patent\StorageService\StorageService;
use App\Services\Utilities\Files\FileDownloader\Contracts\FileDownloaderInterface;
use App\Services\Utilities\Files\FileDownloader\FileDownloader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\Users\User\UserRegister\Register;
use App\Services\Users\BlankUser\KeyGenerator\RandomGenerator;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Utilities\PublicationService\PublicationService;
use App\Services\Utilities\PublicationStorage\PublicationStorage;
use App\Services\Users\BlankUser\KeyGenerator\Contracts\KeyGenerator;
use App\Services\Users\User\InputUpdateTransformer\UpdateDataTransformer;
use App\Services\Users\User\InputUpdateTransformer\Contracts\DataTransformer;
use App\Services\Utilities\PublicationService\Contracts\PublicationServiceInterface;
use App\Services\Utilities\PublicationStorage\Contracts\PublicationStorageInterface;

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
        $this->app->bind(PublicationServiceInterface::class, PublicationService::class);
        $this->app->bind(PublicationStorageInterface::class, PublicationStorage::class);
        $this->app->bind(StorageServiceInterface::class, StorageService::class);
        $this->app->bind(FileDownloaderInterface::class, FileDownloader::class);
    }
}
