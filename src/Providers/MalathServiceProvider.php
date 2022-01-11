<?php

namespace Alaaelsaid\LaravelMalathSms\Providers;

use SmsProcess;
use Illuminate\Support\ServiceProvider;

class MalathServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/malath.php' => config_path('malath.php'),],'malath');
    }

    public function register()
    {
        $this->app->singleton('Malath', fn() => new SmsProcess());

        $this->mergeConfigFrom(__DIR__ . '/../config/malath.php','malath');
    }
}
