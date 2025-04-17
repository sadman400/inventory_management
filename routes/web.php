<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


// user 
Route::post('/register', [UserController::class, 'user_register']);
Route::post('/login', [UserController::class, 'user_login']);
Route::post('/send-otp', [UserController::class, 'send_otp']);
Route::post('/verify-otp', [UserController::class, 'verify_otp']);
Route::post('/reset-password', [UserController::class, 'password_reset'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/user-profile', [UserController::class, 'user_profile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-profile', [UserController::class, 'update_profile'])->middleware([TokenVerificationMiddleware::class]);


// category 
Route::post('/create-category', [CategoryController::class, 'create_category']);
Route::get('/category-list', [CategoryController::class, 'category_list']);
Route::post('/category-by-id', [CategoryController::class, 'category_by_id']);
Route::post('/update-category', [CategoryController::class, 'update_category']);
Route::post('/delete-category', [CategoryController::class, 'delete_category']);


// product 
Route::post('/create-product', [ProductController::class, 'create_product']);
Route::get('/product-list', [ProductController::class, 'product_list']);
Route::post('/product-by-id', [ProductController::class, 'product_by_id']);
Route::post('/update-product', [ProductController::class, 'update_product']);
Route::post('/delete-product', [ProductController::class, 'delete_product']);


// supplier 
Route::post('/create-supplier', [SupplierController::class, 'create_supplier']);
Route::get('/supplier-list', [SupplierController::class, 'supplier_list']);
Route::post('/supplier-by-id', [SupplierController::class, 'supplier_by_id']);
Route::post('/update-supplier', [SupplierController::class, 'update_supplier']);
Route::post('/delete-supplier', [SupplierController::class, 'delete_supplier']);