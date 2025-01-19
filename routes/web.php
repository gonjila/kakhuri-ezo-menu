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

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

//require __DIR__.'/auth.php';
