<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function PHPUnit\Framework\isArray;

class ProductController extends Controller
{
    function index (Request $request) {
        $products = Product::query();

        if($searchQuery = $request->query('search')) {
            $products =  $products->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower($searchQuery) . '%');
        }

        if ($categoryIdQuery = $request->query('category_id')) {
            $products = $products->whereHas('categories', function ($query) use ($categoryIdQuery) {
                $query->where('categories.id', $categoryIdQuery);
            });
        }

        $products = $products->get();

        return Inertia::render('AllDishes', ["products" => ProductResource::collection($products)]);
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
