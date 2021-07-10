<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Home/index');
//     Route::get('/azad', [DashboardController::class, 'index']);


})->name('dashboard');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', [DashboardController::class, 'index'])->name('home.index');
Route::get('/home/product', [DashboardController::class, 'product'])->name('home.product');
Route::get('/home/brand', [DashboardController::class, 'brand'])->name('home.brand');
Route::get('/logout', [DashboardController::class, 'logout']);

//********************_Start Categories_********************

Route::get('/categories/index', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/view', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

//********************_Start Categories_********************

//********************_Start Brand_********************
Route::resource('brand', BrandController::class);
//********************_End Brand_********************
