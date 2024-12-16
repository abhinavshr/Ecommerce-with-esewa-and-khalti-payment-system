<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\KhaltiController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\users\UserRegisterController;
use Illuminate\Support\Facades\Route;

Route::name('user.')->group(function () {
    Route::get('userregister', [UserRegisterController::class, 'view'])->name('userregister');
    Route::post('userregister', [UserRegisterController::class, 'store'])->name('userregister.store');
    Route::get('userlogin', [UserRegisterController::class, 'login'])->name('userlogin');
    Route::post('userlogin', [UserRegisterController::class, 'logincheck'])->name('userlogin.store');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('everythingdisplay', [ProductController::class, 'everythingindex'])->name('everythingdisplay');
    Route::get('fruit', [ProductController::class, 'fruitdisplay'])->name('fruit');
    Route::get('drink', [ProductController::class, 'drinkdisplay'])->name('drink');
    Route::get('/product/{id}', [ProductController::class, 'productdisplay'])->name('product');
    Route::get('/aboutus', [PageController::class, 'aboutindex'])->name('aboutus');
    Route::get('/contactus', [PageController::class, 'contactindex'])->name('contactus');
    Route::post('/contactus', [PageController::class, 'contactusstore'])->name('contactus.store');
    Route::get('privacypolicy', [PageController::class, 'privacypolicyindex'])->name('privacypolicy');
    route::get('terms', [PageController::class, 'termsconditionindex'])->name('terms');
    Route::get('/search', [ProductController::class, 'search'])->name('products.search');
    Route::get('/fruitsearch', [ProductController::class, 'fruitsearch'])->name('fruit.search');
    Route::get('/drinksearch', [ProductController::class, 'drinksearch'])->name('drink.search');
});

Route::name('user.')->middleware(['auth:web'])->group(function () {
    Route::get('logout', [UserRegisterController::class, 'logout'])->name('logout');
    Route::post('/reviews', [ProductController::class, 'store'])->name('reviews.store');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::put('/cart/update/{id}/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}/{productId}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('applycoupon', [CouponController::class, 'applyCoupon'])->name('applycoupon');
    Route::get('checkout/{id}/{productId}', [OrderController::class, 'index'])->name('checkout');
    Route::post('payment', [OrderController::class, 'store'])->name('payment.store');
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('esewa', [EsewaController::class, 'esewapay'])->name('esewa');

    Route::get('/payment-success', [EsewaController::class, 'success'])->name('payment.success');

    // Route for failed payment
    Route::get('/payment-fail', [EsewaController::class, 'fail'])->name('payment.fail');

    // Route for canceled payment
    // Route::get('/payment-cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    Route::get('profile', [PageController::class, 'profileindex'])->name('profile');

    Route::put('/users/{user}', [PageController::class, 'update'])->name('userprofile.update');

    Route::post('/khalti/verify', [KhaltiController::class, 'verifyPayment']);



});
