<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\StoreController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');


        //categories
        Route::get('categories', [CategoryController::class, 'index'])->name('categories');
        Route::get('add_category', [CategoryController::class, 'create'])->name('add_category');
        Route::post('store_category', [CategoryController::class, 'store'])->name('store_category');
        Route::get('edit_category/{category}', [CategoryController::class, 'edit'])->name('edit_category');
        Route::post('update_category/{id}', [CategoryController::class, 'update'])->name('update_category');
        Route::get('delete_category/{category}', [CategoryController::class, 'destroy'])->name('delete_category');
        //products
        Route::get('products', [ProductController::class, 'index'])->name('products');
        Route::get('add_product', [productController::class, 'create'])->name('add_product');
        Route::post('store_product', [productController::class, 'store'])->name('store_product');
        Route::get('edit_product/{product}', [productController::class, 'edit'])->name('edit_product');
        Route::post('update_product/{product}', [productController::class, 'update'])->name('update_product');
        Route::get('delete_product/{product}', [productController::class, 'destroy'])->name('delete_product');

        //stores
        Route::get('stores', [StoreController::class, 'index'])->name('stores');
        Route::get('add_store', [storeController::class, 'create'])->name('add_store');
        Route::post('store_store', [storeController::class, 'store'])->name('store_store');
        Route::get('edit_store/{store}', [storeController::class, 'edit'])->name('edit_store');
        Route::post('update_store/{id}', [storeController::class, 'update'])->name('update_store');
        Route::get('delete_store/{store}', [storeController::class, 'destroy'])->name('delete_store');

        //job
        Route::get('create_users_job', [JobController::class, 'createFakeUsers'])->name('create_users_job');


    });





//special route for notauthenticated persons

    Route::get('/',[AuthController::class,'index'])->name('login');
    Route::post('admin/login',[AuthController::class,'login'])->name('admin.login');



// require __DIR__ . '/auth.php';
