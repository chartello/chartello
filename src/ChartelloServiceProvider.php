<?php

namespace Chartello;

use Chartello\Console\Commands\InstallCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ChartelloServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerConfig();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerMigrations();
        $this->registerPublishing();
        $this->registerCommands();
    }

    protected function registerRoutes()
    {
        Route::middleware(config('chartello.middleware'))
            ->prefix(config('chartello.path'))
            ->name('chartello.')
            ->namespace('Chartello\Http\Controllers')
            ->group(function () {
                $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
            });
    }

    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/chartello.php', 'chartello');
    }

    protected function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chartello');
    }

    protected function registerPublishing()
    {
        $this->publishes([__DIR__.'/../public' => public_path('vendor/chartello')], ['chartello-assets']);

        $this->publishes([__DIR__.'/../config/chartello.php' => config_path('chartello.php')], 'chartello-config');

        $this->publishes(
            [__DIR__.'/../stubs/ProtectChartello.stub' => app_path('Http/Middleware/ProtectChartello.php')],
            'chartello-middleware'
        );
    }

    protected function registerCommands()
    {
        $this->commands([InstallCommand::class]);
    }
}
