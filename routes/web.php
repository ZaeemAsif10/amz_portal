<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\WebController;
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


Route::post('/signup', [RegisterController::class, 'signup'])->name('signup');
Route::get('/signup', [RegisterController::class, 'signup_view']);


// Your desired default route URI
$desiredDefaultRoute = 'buyer';

// Redirect the root URL to the desired default route
Route::redirect('/', $desiredDefaultRoute);

Route::any('buyer', [WebController::class, 'index'])->name('/');


Route::group(['middleware' => ['auth', 'activity']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/profile/{id?}', [HomeController::class, 'Profile']);
    Route::post('/profile_update', [HomeController::class, 'profileUpdate']);

    //customer routes
    Route::any('customers', [CustomerController::class, 'index'])->middleware('role');
    Route::get('customers-status', [CustomerController::class, 'customersStatus'])->middleware('role');
    Route::get('customer_details/{customer_id?}', [CustomerController::class, 'customerDetails'])->middleware('role');

    //Products routes
    Route::any('products', [ProductController::class, 'index']);
    Route::get('create-products/{id?}', [ProductController::class, 'createProducts']);
    Route::post('store-products', [ProductController::class, 'storeProducts']);
    Route::get('enabled', [ProductController::class, 'Enabled']);
    Route::get('disabled', [ProductController::class, 'Disabled']);
    Route::get('update_status', [ProductController::class, 'updateStatus']);
    Route::get('product_detail/{product_no}', [ProductController::class, 'productDetail']);
    Route::post('update_product_detail', [ProductController::class, 'updateProductDetail']);

    Route::post('reserve_now', [ProductController::class, 'reserveNow']);
    Route::get('reservations/{role?}/{pmm_id?}', [ProductController::class, 'Reservations']);
    Route::get('remove_reservation', [ProductController::class, 'removeReservation']);

    Route::get('/get_remaining_time/{cellId}', [ProductController::class, 'getRemainingTime']);

    //Order Routes
    Route::any('all_orders/{pmm_id?}', [OrderController::class, 'index']);
    Route::get('create_order/{product_no?}', [OrderController::class, 'createOrder']);
    Route::post('order_now', [OrderController::class, 'orderNow']);
    Route::get('order_detail/{order_limit}', [OrderController::class, 'orderDetail']);
    Route::post('update_order_detail', [OrderController::class, 'updateOrderDetail']);


    Route::any('ordered/{pmm_id?}', [OrderController::class, 'Ordered']);
    Route::any('reviewed/{pmm_id?}', [OrderController::class, 'Reviewed']);
    Route::any('delivered/{pmm_id?}', [OrderController::class, 'Delivered']);
    Route::any('reviewed_deleted/{pmm_id?}', [OrderController::class, 'ReviewedDeleted']);
    Route::any('refunded/{pmm_id?}', [OrderController::class, 'Refunded']);
    Route::any('on_hold/{pmm_id?}', [OrderController::class, 'onHold']);
    Route::any('pending/{pmm_id?}', [OrderController::class, 'Pending']);
    Route::any('cancelled/{pmm_id?}', [OrderController::class, 'Cancelled']);
    Route::any('completed/{pmm_id?}', [OrderController::class, 'Completed']);

    //Report route
    Route::any('report', [ReportController::class, 'index']);
});
