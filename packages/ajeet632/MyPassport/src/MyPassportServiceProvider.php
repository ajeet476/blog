<?php

namespace ajeet632\MyPassport;

use Illuminate\Support\ServiceProvider;

class MyPassportServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        /* Publish Config*/
        $this->publishes([
            __DIR__ . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'myPassport.php'                                                  => config_path('myPassport.php'),
        ], 'MyPassport');

        // Routing
        include __DIR__ . DIRECTORY_SEPARATOR . 'routes.php';

    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}