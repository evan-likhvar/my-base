<?php

namespace Elikh\LocaleMiddleware;

use Illuminate\Support\ServiceProvider;

class SetLocaleServiceProvider extends ServiceProvider
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
        app('router')->aliasMiddleware('set.locale',SetLocaleMiddleware::class);
        $this->publishes([
            __DIR__.'/src/site-locales.php' => config_path('site-locales.php'),
        ]);
    }
}
