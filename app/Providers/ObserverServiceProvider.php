<?php

namespace App\Providers;

use App\Models\App\File;
use App\Observers\FileObserver;
use App\Observers\PatentObserver;
use App\Observers\ArticleObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\Publications\Patents\Patent;
use App\Models\Publications\Articles\Article;
use App\Utilities\Observers\MorphRelationsDelete;
use App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        File::observe(FileObserver::class);
        Article::observe(ArticleObserver::class);
        Patent::observe(PatentObserver::class);
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
