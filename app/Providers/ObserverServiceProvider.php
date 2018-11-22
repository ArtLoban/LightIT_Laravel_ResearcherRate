<?php

namespace App\Providers;

use App\Models\App\File;
use App\Observers\FileObserver;
use App\Observers\ArticleObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Publications\Articles\Article\Article;
use App\Services\Utilities\Observers\MorphRelationsDelete;
use App\Services\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Article::observe(ArticleObserver::class);
        File::observe(FileObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MorphRelationsDeleteInterface::class, MorphRelationsDelete::class);
    }
}
