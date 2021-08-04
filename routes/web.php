<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

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

Route::get('/categories/create',[CategoryController::class, 'generate'])->name('categories.generate');
Route::get('/categories/sub-categories/one',[CategoryController::class, 'subCategoriesOne'])->name('categories.subcategories.one');
Route::post('/categories/subcategoriesOne/store',[CategoryController::class, 'subCategoriesOneStore']);
Route::get('/categories/sub-categories/two',[CategoryController::class, 'subCategoriesTwo'])->name('categories.subcategories.two');
Route::post('/categories/subcategoriesTwo/store',[CategoryController::class, 'subCategoriesTwoStore']);


//********************_Start Categories_********************

//********************_Start Brand_********************

Route::resource('brand', BrandController::class);
Route::post('/brand/{id}/update', [BrandController::class, 'update'])->name('brand.update');
Route::get('/brand/{id}/delete', [BrandController::class, 'destroy'])->name('brand.delete');

//********************_End Brand_********************
//********************_start Product_********************

Route::resource('product', ProductController::class);
Route::get('/products/generate', [ProductController::class, 'generates'])->name('products.generate');
Route::post('/products/store', [ProductController::class, 'store']);
Route::get('/products/{slug}/images', [ProductController::class, 'productImages'])->name('products.images');
Route::post('/products/{slug}/images/store', [ProductController::class, 'productImagesStore']);
Route::post('/brand/{id}/update', [ProductController::class, 'update'])->name('brand.update');
Route::get('/brand/{id}/delete', [ProductController::class, 'destroy'])->name('brand.delete');


Route::get('/customer', [CustomerController::class, 'index']);



//********************_End Product_********************
