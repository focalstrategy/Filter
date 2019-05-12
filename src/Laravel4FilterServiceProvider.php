<?php

namespace FocalStrategy\Filter;

use Illuminate\Support\ServiceProvider;
use View;

class Laravel4FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::addNamespace('filter', __DIR__.'/views_4');
    }
}
