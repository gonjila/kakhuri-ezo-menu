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

        return Inertia::render('SingleProduct', [
            'product' => new ProductResource($product),
            'categories' => CategoryResource::collection($product->categories)
        ]);
    }

}
