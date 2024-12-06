<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Public Routes
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function () {
        return response()->json(['message' => 'User endpoint accessed']);
    });

    Route::get('/admin', function () {
        return response()->json(['message' => 'Admin endpoint accessed']);
    })->middleware('role:admin');

    Route::post('/logout', [LoginController::class, 'logout']);
});

//Products
Route::middleware(['auth:sanctum', 'role:admin'])->prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/create', [ProductController::class, 'store']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

//Order
Route::middleware(['auth:sanctum'])->get('/orders', [OrderController::class, 'fetchOrders']);
Route::middleware(['auth:sanctum'])->post('/orders', [OrderController::class, 'store']);

//Payment
Route::middleware(['auth:sanctum'])->post('/pay', [PaymentController::class, 'createPayment']);
Route::middleware(['auth:sanctum'])->post('/payments/confirm', [PaymentController::class, 'confirmPayment']);
