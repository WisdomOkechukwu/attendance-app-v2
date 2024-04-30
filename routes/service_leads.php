<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::GET('/metrics', [AuthController::class, 'login']);
Route::GET('/members', [AuthController::class, 'login']);

Route::POST('/validate-login', [AuthController::class, 'validateLogin']);
