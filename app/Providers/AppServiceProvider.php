<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Task;
use App\Repositories\FileRepositoryEloquent;
use App\Repositories\TaskRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('App\Repositories\TaskRepositoryInterface', 'App\Repositories\TaskRepositoryEloquent');
        $this->app->bind('App\Repositories\TaskRepositoryInterface', function(){
            return new TaskRepositoryEloquent( new Task());
        });

        $this->app->bind('App\Repositories\FileRepositoryInterface', 'App\Repositories\FileRepositoryEloquent');
        $this->app->bind('App\Repositories\FileRepositoryInterface', function(){
            return new FileRepositoryEloquent( new File());
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
