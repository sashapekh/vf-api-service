<?php

namespace Sashapekh\VfApi;

use Illuminate\Support\ServiceProvider as Provider;

class VfApiServiceProvider extends Provider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/vf-service-variables.php' => config_path('vf-service-variables.php')
        ], 'public');

        $this->publishes([
            __DIR__ . '/Migrations' => $this->app->databasePath() . '/migrations'
        ], 'vf-service-migrations');

        $this->publishes([
            __DIR__ . '/Models' => $this->app->basePath() . '/app/Models'
        ], 'models');
    }

    public function register()
    {

    }
}

