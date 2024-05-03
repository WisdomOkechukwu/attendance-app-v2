<?php

use App\Http\Controllers\FollowUpLead\AnalyticsController;
use App\Http\Controllers\FollowUpLead\LocationController;
use Illuminate\Support\Facades\Route;

Route::GET('/', [AnalyticsController::class, 'metrics'])->name('analytics.metrics');

Route::name('location.')->prefix('location')->group(function() {
    Route::GET('/', [LocationController::class, 'index'])->name('index');
});


