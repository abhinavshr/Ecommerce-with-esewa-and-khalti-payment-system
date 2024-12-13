<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProductListCOntroller;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('adminregister', [AdminRegisterController::class, 'view'])->name('adminregister');
    Route::post('adminregister', [AdminRegisterController::class, 'register'])->name('adminregister.store');

    Route::get('adminlogin', [AdminLoginController::class, 'view'])->name('adminlogin');
    Route::post('adminlogin', [AdminLoginController::class, 'login'])->name('adminlogin.check');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('product', [ProductListCOntroller::class, 'index'])->name('product');
    Route::get('logout', [AdminLoginController::class, 'destory'])->name('logout');
    Route::get('addproduct', [ProductListCOntroller::class, 'addProduct'])->name('addproduct');
    Route::post('addproduct', [ProductListCOntroller::class, 'store'])->name('addproduct.store');
    Route::delete('product/{id}', [ProductListCOntroller::class, 'destroy'])->name('product.destroy');
    Route::get('editproduct/{id}', [ProductListCOntroller::class, 'edit'])->name('product.edit');
    Route::put('editproduct/{id}', [ProductListCOntroller::class, 'update'])->name('product.update');
    Route::get('adminlist', [AdminListController::class, 'index'])->name('adminlist');
    Route::get('adminsetting', [AdminController::class, 'index'])->name('adminsetting');
    Route::put('adminsetting/{id}', [AdminController::class, 'update'])->name('adminsetting.update');
    Route::delete('adminsetting/{id}', [AdminController::class, 'destroy'])->name('adminsetting.destroy');
    Route::get('userlist', [AdminListController::class, 'userlist'])->name('userlist');
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('addcoupon', [CouponController::class, 'addcoupanindex'])->name('addcoupon');
    Route::post('addcoupon', [CouponController::class, 'store'])->name('addcoupon.store');
    Route::get('addlocation', [DeliveryController::class, 'viewaddlocation'])->name('addlocation');
    Route::get('location', [DeliveryController::class, 'viewlocation'])->name('location');
    Route::post('addlocation', [DeliveryController::class, 'storelocation'])->name('addlocation.store');
});
