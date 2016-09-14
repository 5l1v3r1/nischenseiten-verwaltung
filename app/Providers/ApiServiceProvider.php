<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
                ['project.dashboard','layouts.fullwidth','partials.project.keyword-tr','project.keywords','project.sidebar','project.ranking','ideas.index', 'partials.ideas.idea-tr'], 
                'App\Composers\ApiComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
