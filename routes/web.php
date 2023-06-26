<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Models\Product;
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


Auth::routes();


Route::get('/signup', [RegisterController::class, 'signup_view']);
Route::post('/signup', [RegisterController::class, 'signup'])->name('signup');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('/');

    //customer routes
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers-status', [CustomerController::class, 'customersStatus']);

    //Products routes
    Route::any('products', [ProductController::class, 'index']);
    Route::get('create-products', [ProductController::class, 'createProducts']);
    Route::post('store-products', [ProductController::class, 'storeProducts']);
    Route::get('enabled', [ProductController::class, 'Enabled']);
    Route::get('disabled', [ProductController::class, 'Disabled']);
    Route::get('update_status', [ProductController::class, 'updateStatus']);
    Route::get('product_detail/{product_no}', [ProductController::class, 'productDetail']);
    Route::post('update_product_detail', [ProductController::class, 'updateProductDetail']);

    Route::post('reserve_now', [ProductController::class, 'reserveNow']);
    Route::get('reservations', [ProductController::class, 'Reservations']);
    Route::get('remove_reservation', [ProductController::class, 'removeReservation']);

    //Order Routes
    Route::get('all_orders', [OrderController::class, 'index']);
    Route::get('create_order/{product_no?}', [OrderController::class, 'createOrder']);
    Route::post('order_now', [OrderController::class, 'orderNow']);
    Route::get('order_detail/{order_limit}', [OrderController::class, 'orderDetail']);
    Route::post('update_order_detail', [OrderController::class, 'updateOrderDetail']);
});
