<?php

use Chartello\Lite\Http\Controllers\DashboardPanelsController;
use Chartello\Lite\Http\Controllers\DashboardsController;
use Chartello\Lite\Http\Controllers\HomeController;
use Chartello\Lite\Http\Controllers\PanelsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('dashboards', DashboardsController::class)->only(['show', 'update', 'store', 'destroy']);
Route::resource('dashboards/{dashboard}/panels', DashboardPanelsController::class)->only('store');
Route::resource('panels', PanelsController::class)->only(['update', 'destroy']);
