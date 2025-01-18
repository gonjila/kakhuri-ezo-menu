<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    function index () {
        return Inertia::render('AllDishes', ["products" => Product::all()]);
    }

    function get($productId){
        $product = Product::with('categories')->findOrFail($productId);

        $similarProducts = Product::whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
            ->where('id', '!=', $product->id) // Exclude the current product
            ->take(8) // Limit the number of similar products (optional)
            ->get();

        return Inertia::render('SingleProduct', [
            'product' => new ProductResource($product),
            'categories' => CategoryResource::collection($product->categories),
            'similarProducts' => ProductResource::collection($similarProducts)
        ]);
    }

}
