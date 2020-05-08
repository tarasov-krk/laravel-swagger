<?php

namespace RonasIT\Support\AutoDoc;

use Illuminate\Support\ServiceProvider;

class LocalDataCollectorServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/local-data-collector.php' => config_path('local-data-collector.php'),
        ], 'config');
    }

    public function register() {}
}
