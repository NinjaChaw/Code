<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
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
        // url() can not be called inside config files, that's why a separate service provider is required
        // automatically transform relative urls to absolute to avoid manually adding them
        foreach (['facebook','google','twitter','linkedin'] as $provider) {
            config([
                'services.'.$provider.'.redirect' => url(config('services.'.$provider.'.redirect')),
            ]);
        }
    }
}