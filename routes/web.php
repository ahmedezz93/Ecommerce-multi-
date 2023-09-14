<?php

use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\OrderController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\front\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'site','middleware'=>'auth:web'],function(){
    Route::get('home',[HomeController::class,'index'])->name('home');


//products

Route::get('product_details/{product:slug}',[ProductController::class,'show'])->name('product_details');

//carts

Route::get('cart',[CartController::class,'index'])->name('cart');
Route::get('add_to_cart/{Product}',[CartController::class,'add'])->name('add.to.cart');
Route::post('update_cart/{Product_id}',[CartController::class,'update'])->name('update_cart');
Route::get('delete_cart/{cart}',[CartController::class,'delete'])->name('delete_cart');

//orders
Route::get('orders',[OrderController::class,'create'])->name('orders');
Route::post('checkout',[OrderController::class,'store'])->name('checkout');

//socialLoginRoutes

Route::get('auth/{provider}/redirect',[SocialLoginController::class,'redirect'])->name('auth.provider.redirect');
Route::get('auth/google/callback',[SocialLoginController::class,'callback']);

//paymentController



});
Route::get('user/login',[AuthController::class,'login'])->name('user.login');
Route::post('user/login',[AuthController::class,'loginUser']);

Route::get('user/register',[AuthController::class,'register'])->name('user.register');
Route::post('user/register',[AuthController::class,'registerUser']);

