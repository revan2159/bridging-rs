<?php

namespace Satusehat\Bridging;

use Illuminate\Support\ServiceProvider;

class SatusehatServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '../../routes.php';

        $this->publishes([
            __DIR__ . '../../../config/satusehat.php' => config_path('satusehat.php'),
        ], 'config');
    }
}
