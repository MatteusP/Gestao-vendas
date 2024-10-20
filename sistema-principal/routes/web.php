<?php

use App\Http\Controllers\CouponsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Cache\Store;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    

    Route::view('/register', 'auth.register')->name('register');

    //rota para dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    //rotas para usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/show/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    //rotas para cupons
    Route::post('/apply-coupon', [CouponsController::class, 'applyCoupon'])->name('apply.coupons');

    //rotas para produtos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/show/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    //rotas para vendas
    Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');

    
});

Route::get('/home', function () {
    return view('Users');
});



require __DIR__.'/auth.php';
