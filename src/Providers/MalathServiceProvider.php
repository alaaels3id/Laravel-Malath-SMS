<?php

namespace Alaaelsaid\LaravelMalathSms\Providers;

use Illuminate\Support\ServiceProvider;
use Alaaelsaid\LaravelMalathSms\Facade\SmsProcess;

class MalathServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/../../config/malath.php' => config_path('malath.php')],'malath');
    }

    public function register()
    {
        $this->app->singleton('Malath', fn() => new SmsProcess());

        $this->mergeConfigFrom(__DIR__ . '/../../config/malath.php','malath');
    }
}
