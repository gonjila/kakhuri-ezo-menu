<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class DashboardController extends Controller
{
    function welcome() {
        try {
            return Inertia::render('Welcome', [
                'categories' => CategoryResource::collection(Category::all()),
                'popular' => ProductResource::collection(Product::where('is_popular', true)->take(12)->get()),
                'discounted' => ProductResource::collection(Product::where('discount', ">", 0)->latest('updated_at')->take(12)->get()),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Get dashboard data failed!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
