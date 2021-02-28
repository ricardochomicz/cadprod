<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

    Route::get('admin/reports/months', [ReportsController::class, 'months'])->name('reports.months');
    Route::get('admin/reports/years', [ReportsController::class, 'years'])->name('reports.years');

    Route::get('admin', function () {
    })->name('admin');
    /**
     * Routes Users
     */
    Route::any('admin/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('admin/users', UserController::class);
    /**
     * Routes Products
     */
    Route::any('admin/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::resource('admin/products', ProductController::class);
    /**
     * Routes Categories
     */
    Route::any('admin/categories/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::resource('admin/categories', CategoryController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
