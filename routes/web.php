<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/set-language', function (\Illuminate\Http\Request $request) {
    $lang = $request->input('lang');

    if (in_array($lang, ['en', 'ka'])) { // Adjust available locales as needed
        App::setLocale($lang);
        Session::put('locale', $lang); // Store the locale in session
    }

    return redirect()->back();  // Set a cookie for 30 days
})->name('set-language');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'categories' => Category::all(),
        'popular' => ProductResource::collection(Product::where('is_popular', true)->take(12)->get()),
    ]);
})->name('home');

Route::prefix('products')->controller(ProductController::class)->group(function () {
    Route::get('/', "index")->name('all-products');

    Route::get('/{productId}', 'get')->name('product');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//require __DIR__.'/auth.php';
