<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::GET('/', [GuestController::class, 'index']);

Route::GET('/login', [AuthController::class, 'login'])->name('auth.login');
Route::POST('/validate-login', [AuthController::class, 'validateLogin'])->name('auth.validate');
