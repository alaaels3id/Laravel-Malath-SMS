<?php

namespace Alaaelsaid\LaravelMalathSms\Providers;

use Illuminate\Support\ServiceProvider;
use SmsProcess;

class MalathServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/malath.php' => config_path('malath.php'),],'malath');

        $this->app->singleton('Malath', function () {
            return new SmsProcess();
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/malath.php','malath');
    }
}
