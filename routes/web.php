<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::resource('orders', OrderController::class);

    Route::get('reports/vue', [ReportsController::class, 'vue'])->name('reports.vue');
    Route::get('reports/months', [ReportsController::class, 'months'])->name('reports.months');
    Route::get('reports/years', [ReportsController::class, 'years'])->name('reports.years');

    Route::get('/', function () {
    })->name('admin');
    /**
     * Routes Users
     */
    Route::any('users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('users', UserController::class);
    /**
     * Routes Products
     */
    Route::any('products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('products', ProductController::class);
    /**
     * Routes Categories
     */
    Route::any('categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('categories', CategoryController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
