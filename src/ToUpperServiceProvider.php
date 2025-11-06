<?php

namespace RiseTechApps\ToUpper;

use Illuminate\Support\ServiceProvider;

class ToUpperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('to-upper.php'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'to-upper');

        $this->app->singleton(ToUpper::class, function ($app) {
            return new ToUpper($app['config']->get('to-upper', []));
        });

        $this->app->alias(ToUpper::class, 'to-upper');
    }
}
