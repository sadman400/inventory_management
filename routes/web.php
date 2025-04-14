<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'user_register']);
Route::post('/login', [UserController::class, 'user_login']);