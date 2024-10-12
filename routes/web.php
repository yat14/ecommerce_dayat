<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\FlashController;
use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\User\UserController;




// Guest Route
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
// Register Route
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');
    
    Route::post('/post-login', [AuthController::class, 'login']);
})->middleware('guest');

// Admin Route
Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Product Route
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/product/detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Flash Sale Route
    Route::get('/flash', [FlashController::class, 'index'])->name('admin.flash');
    Route::get('/flash/create', [FlashController::class, 'create'])->name('flash.create');
    Route::post('/flash/store', [FlashController::class, 'store'])->name('flash.store');
    Route::get('/admin/flash/detail/{id}', [FlashController::class, 'detail'])->name('flash.detail');
    Route::get('/flash/edit/{id}', [FlashController::class, 'edit'])->name('flash.edit');
    Route::post('/flash/update/{id}', [FlashController::class, 'update'])->name('flash.update');
    Route::delete('/flash/delete/{id}', [FlashController::class, 'delete'])->name('flash.delete');


    // Distributor Route
    Route::get('/distributor', [DistributorController::class,'index'])->name('admin.distributor');
    Route::get('/distributor/create', [DistributorController::class, 'create'])->name('distributor.create');
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('distributor.edit');
    Route::post('/distributor/update/{id}', [DistributorController::class, 'update'])->name('distributor.update');
    Route::delete('/distributor/delete/{id}', [DistributorController::class, 'delete'])->name('distributor.delete');
    Route::get('/admin/distributor/detail/{id}', [DistributorController::class, 'detail'])->name('distributor.detail');
    Route::post('/distributor/publish', [DistributorController::class, 'publish'])->name('distributor.publish');

    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
})->middleware('admin');

// User Route
Route::group(['middleware' => 'web'], function() {
    Route::get('/user', [UserController::class,'index'])->name('user.dashboard');

    // Product Route
    Route::get('/user/product/detail/{id}', [UserController::class, 'detail_product'])->name('user.detail.product');
    Route::get('/user/flash/detailFlash/{id}', [UserController::class, 'detail_flash'])->name('user.detailFlash.flash');
    Route::get('/product/purchase/{productId}/{userId}', [UserController::class, 'purchase']);
    Route::get('/flash/purchaseFlash/{flashId}/{userId}', [UserController::class, 'purchaseFlash']);
    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');
})->middleware('web');   
