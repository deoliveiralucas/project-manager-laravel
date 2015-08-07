<?php

namespace ProjectManager\Providers;

use Illuminate\Support\ServiceProvider;

class ProjectManagerRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \ProjectManager\Repositories\ClientRepository::class, 
            \ProjectManager\Repositories\ClientRepositoryEloquent::class
        );
        
        $this->app->bind(
            \ProjectManager\Repositories\ProjectRepository::class,
            \ProjectManager\Repositories\ProjectRepositoryEloquent::class
        );
    }
}
