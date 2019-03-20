<?php

namespace FocalStrategy\Filter;

use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'filter');
        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/filter'),
        ]);
    }
}
