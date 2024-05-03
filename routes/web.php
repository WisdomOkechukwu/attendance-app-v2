<?php

use App\DashboardRoute;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('guest.index');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/validate-login', [AuthController::class, 'validateLogin'])->name('auth.validate');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return DashboardRoute::getHomePage(auth()->user());
    });
});

