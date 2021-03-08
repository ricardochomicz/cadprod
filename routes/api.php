<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Api\ReportsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('vproducts', [ProductController::class, 'getProductsVue'])->name('vproducts');
Route::get('vproducts/{id}/show', [OrderController::class, 'showProductOrder'])->name('vproducts-show');
Route::group(['prefix' => 'reports', 'namespace' => 'Api'], function () {
    Route::get('months', [ReportsApiController::class, 'months']);
});


   

