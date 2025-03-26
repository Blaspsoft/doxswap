<?php

namespace Blaspsoft\Doxswap;

use Blaspsoft\Doxswap\Doxswap;
use Illuminate\Support\ServiceProvider;
use Blaspsoft\Doxswap\Converter;

class DoxswapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('doxswap.php'),
            ], 'doxswap-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'doxswap');

        $this->app->bind('doxswap', function () {
            return new Doxswap();
        });
    }
}
