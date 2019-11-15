<?php

namespace Aping\LaravelOpcacheGui;

use Illuminate\Support\ServiceProvider;

class OpcacheServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $viewPath = __DIR__.'/Resources/views';

        $this->loadViewsFrom($viewPath, 'laravel-opcache-gui');

        $this->publishes([
            $viewPath => resource_path('/views/vendor/laravel-opcache-gui'),
        ], 'views');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
