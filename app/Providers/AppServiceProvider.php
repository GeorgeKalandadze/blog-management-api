<?php

namespace App\Providers;

use App\Repositories\Contracts\PostsRepositoryContract;
use App\Repositories\Decorators\PostCachingRepositoryDecorator;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostsRepositoryContract::class, function ($app) {
            return new PostCachingRepositoryDecorator(new PostRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
