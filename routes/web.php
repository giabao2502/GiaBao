<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
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

Route::get('', [HomeController::class, 'index'])->name('home.index');
Route::get('product/{product}', [HomeController::class, 'product'])->name('home.product_detail');
Route::post('product-comment/{product}', [HomeController::class, 'productComment'])->name('home.product_comment');
Route::get('delete-comment/{comment}', [HomeController::class, 'deleteComment'])->name('home.deleteComment');

// route sẽ hiển thị form login
Route::get('login', [HomeController::class, 'login'])->name('home.login');
// route này validate dữ liệu khi submit form
Route::post('login', [HomeController::class, 'check_login']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'customer'], function () {
    // Phương thức get hiển thị form login
    Route::get('login', [CustomerController::class, 'login'])->name('customer.login');
    // Phương thức post để thực hiện login khi submit form
    Route::post('login', [CustomerController::class, 'post_login'])->name('customer.login');
    // Phương thức get hiển thị form register
    Route::get('register', [CustomerController::class, 'register'])->name('customer.register');
    // Phương thức post để thực hiện register khi submit form
    Route::post('register', [CustomerController::class, 'post_register'])->name('customer.register');;
    // Phương thức logout cho khách hàng
    Route::post('logout', [CustomerController::class, 'logout'])->name('customer.logout');
});


// routes/web.php
Route::post('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');


use App\Http\Controllers\CartController;

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
