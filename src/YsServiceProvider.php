<?php

namespace Test\Ys;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class YsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('ys', \Test\Ys\Middleware\YsMiddleware::class);

        $this->publishes([
            __DIR__.'/Config/ys.php' => config_path('ys.php'),
        ], 'ys_config');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'ys');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/ys'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/Views', 'ys');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/ys'),
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/ys'),
        ], 'ys_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Test\Ys\Commands\YsCommand::class,
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
            __DIR__ . '/Config/ys.php', 'ys'
        );
    }
}
