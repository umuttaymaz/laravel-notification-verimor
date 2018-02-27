<?php

namespace UmutTaymaz\VerimorSMS;

use Illuminate\Support\ServiceProvider;

class VerimorSMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Bootstrap code here.

        $this->app->singleton(VerimorSMSApi::class, function () {
            return new VerimorSMSApi();
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
