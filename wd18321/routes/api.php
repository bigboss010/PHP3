<?php

use App\Http\Controllers\Api\ProductController;
use App\Models\Product;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// http://127.0.0.1:8000/api/list-product
Route::get('/list-product', [ProductController::class, 'listProduct']);

// http://127.0.0.1:8000/api/product-detail
Route::get('/product-detail/{id}', [ProductController::class, 'detailProduct']);

// http://127.0.0.1:8000/api/product-add
Route::post('/product-add', [ProductController::class, 'addProduct']);

// http://127.0.0.1:8000/api/product-update
Route::patch('/product-update/{id}', [ProductController::class, 'updateProduct']);

// http://127.0.0.1:8000/api/product-delete
Route::delete('/product-delete/{id}', [ProductController::class, 'deleteProduct']);
