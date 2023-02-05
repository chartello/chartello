<?php

namespace Chartello\Lite;

use Chartello\Lite\Console\Commands\InstallCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ChartelloServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::name('chartello.')->group([
            'prefix' => config('chartello.path', ''),
            'namespace' => 'Chartello\Lite\Http\Controllers',
            'middleware' => config('chartello.middleware', 'web'),
        ], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        $this->commands([InstallCommand::class]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chartello');

        $this->mergeConfigFrom(__DIR__.'/../config/chartello.php', 'chartello');

        $this->publishes([__DIR__.'/../public' => public_path('vendor/chartello'),], ['chartello-assets']);

        $this->publishes([__DIR__.'/../config/chartello.php' => config_path('chartello.php'),], 'chartello-config');

        $this->publishes(
            [__DIR__.'/../stubs/ProtectChartello.stub' => app_path('Http/Middleware/ProtectChartello.php'),],
            'chartello-middleware'
        );
    }
}