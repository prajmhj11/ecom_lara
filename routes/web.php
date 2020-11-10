<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing-page');

Route::get('/admin-login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');

// Products
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{product}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');

// Laravel Cart

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');

Route::patch('/cart/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.delete');
Route::post('/cart/switchToSaveForLater/{product}', [App\Http\Controllers\CartController::class, 'switchToSaveForLater'])->name('cart.switchToSaveForLater');

Route::delete('/saveforlater/{product}', [App\Http\Controllers\SaveForLaterController::class, 'destroy'])->name('saveForLater.delete');
Route::post('/saveforlater/switchToCart/{product}', [App\Http\Controllers\SaveForLaterController::class, 'switchToCart'])->name('saveForLater.switchToCart');

Route::get('/empty-cart', function(){
    \Cart::destroy();
    return redirect()->route('cart.index')->with('success_message','Cart Emptied');
});
Route::get('/empty-saveforlater', function(){
    \Cart::instance('saveForLater')->destroy();
    return redirect()->route('cart.index')->with('success_message', 'SaveForLater Emptied');
});

// Coupon

Route::post('/coupon', [App\Http\Controllers\CouponController::class, 'store'])->name('coupon.store');
Route::delete('/coupon', [App\Http\Controllers\CouponController::class, 'destroy'])->name('coupon.destroy');

// checkout -> middleware=>auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/thankyou', [App\Http\Controllers\ConfirmationController::class, 'index'])->name('confirmation.index');

Route::get('/about', function() {
    return view('layouts.ecom.about');
});

// Profile
Route::group(['middleware' => 'auth'], function () {
    Route::get('my-profile', [App\Http\Controllers\UsersController::class, 'edit'])->name('users.edit');
    Route::patch('my-profile', [App\Http\Controllers\UsersController::class, 'update'])->name('users.update');
    Route::get('my-orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
});
Auth::routes();


// Algolia
Route::get('/search', [App\Http\Controllers\ShopController::class, 'search'])->name('search');
Route::get('/search-algolia', [App\Http\Controllers\ShopController::class, 'searchAlgolia'])->name('search-algolia');

// Admin-------
Route::get('/adminpanel', function () {
    return view('admin');
});


Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\HomeController::class, 'index'])->name('profile');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/users', [App\Http\Controllers\HomeController::class, 'index'])->name('users');
    Route::get('/developer', [App\Http\Controllers\HomeController::class, 'index'])->name('developer');
});
/* Payment Integration (E-sewa, Fonepay)

    // Route::get('/products', [App\Http\Controllers\ProductController::class, 'list'])->name('products');
    // Route::post('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');

    // Route::any('/esewa/success', 'App\Http\Controllers\EsewaController@success')->name('esewa.success');
    // Route::any('/esewa/fail', 'App\Http\Controllers\EsewaController@fail')->name('esewa.fail');
    // Route::get('/payment/response', 'App\Http\Controllers\EsewaController@payment_response')->name('payment.response');

    // Route::any('fonepay/return', 'App\Http\Controllers\FonepayController@fonepay_response')->name('fonepay.return');
    // // Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');
*/

// Vayoger Admin
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
