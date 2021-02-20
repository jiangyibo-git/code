<?php

namespace Jyb\Demo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class DemoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('demo', \Jyb\Demo\Middleware\DemoMiddleware::class);

        $this->publishes([
            __DIR__.'/Config/demo.php' => config_path('demo.php'),
        ], 'demo_config');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'demo');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/demo'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/Views', 'demo');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/demo'),
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/demo'),
        ], 'demo_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Jyb\Demo\Commands\DemoCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/demo.php', 'demo'
        );
    }
}
