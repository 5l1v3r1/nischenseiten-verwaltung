<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ProjectListProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
                ['dashboard'],
                'App\Composers\ProjectComposer'
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
