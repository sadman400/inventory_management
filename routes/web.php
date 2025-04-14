<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'user_register']);
Route::post('/login', [UserController::class, 'user_login']);
Route::post('/send-otp', [UserController::class, 'send_otp']);
Route::post('/verify-otp', [UserController::class, 'verify_otp']);