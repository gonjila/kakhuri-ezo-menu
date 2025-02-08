<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/set-language', [LanguageController::class, 'index'])->name('set-language');

Route::get('/', [DashboardController::class, 'welcome'])->name('home');

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', "index")->name('all-products');

    Route::get('/{productId}', 'get')->name('product');
});
