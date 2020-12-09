<?php

namespace Sashapekh\VfApi;

use Illuminate\Support\ServiceProvider as Provider;
use Sashapekh\VfApi\Service\SendSmsService;

class VfApiServiceProvider extends Provider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton(SendSmsService::class, function () {
            return new SendSmsService();
        });
    }
}

