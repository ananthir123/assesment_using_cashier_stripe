<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index']);
Route::get('product-view/{id}',[ProductController::class, 'show']);
Route::get('buy-now/{id}',         [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'payment']);
Route::get('/success', [PaymentController::class, 'success']);
