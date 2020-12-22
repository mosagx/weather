<?php

namespace Mosagx\Weather;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/amap.php', 'amap'
        );

        $this->app->singleton(Weather::class, function () {
            return new Weather(config('amap.weather.key'));
        });

        $this->app->alias(Weather::class, 'weather');
    }

    public function provides()
    {
        return [Weather::class, 'weather'];
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/amap.php' => config_path('amap.php'),
        ], 'mosagx amap-config');
    }
}