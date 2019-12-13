<?php

namespace Mguinea\QueryUpdater;

use Illuminate\Support\ServiceProvider;

class QueryUpdaterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/query-updater.php' => config_path('query-updater.php'),
        ], 'query-updater');


    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/query-updater.php', 'query-updater');
    }
}