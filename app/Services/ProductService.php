<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductService
{
   public function getAllProducts(): \Inertia\Response
   {
        $products = Product::query();

        if($searchQuery = request()->query('search')) {
            $products =  $products->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower($searchQuery) . '%');
        }

        if ($categoryIdQuery = request()->query('category_id')) {
            $products = $products->whereHas('categories', function ($query) use ($categoryIdQuery) {
                $query->where('categories.id', $categoryIdQuery);
            });
        }

        $products = $products->get();

        return Inertia::render('AllProduct', ["products" => ProductResource::collection($products)]);
    }

    public function getProductById(int $id): \Inertia\Response
    {
        $product = Product::with('categories')->findOrFail($id);

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
