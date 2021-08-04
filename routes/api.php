<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CustomerController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('categories', CategoryController::class);
Route::get('product/{name}', [ProductController::class, 'getProduct']);
Route::get('product/productDetails/{slug}', [ProductController::class, 'productDetails']);
Route::get('categoriess/{id}', [ProductController::class, 'categoriesFilter']);
Route::get('productList/{type}', [ProductController::class, 'categoriesFilterProduct']);
Route::get('brand/list', [BrandController::class, 'allBrand']);
Route::get('brands/{id}', [ProductController::class, 'brandFilterProduct']);
Route::post('/customer/register', [CustomerController::class, 'store']);

