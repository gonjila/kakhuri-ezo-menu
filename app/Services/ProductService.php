<?php

namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductService
{
   public function getAllProducts(): \Inertia\Response
   {
       $searchQuery = request()->query('search');
       $categoryIdQuery = request()->query('category_id');

       $categories = Category::query();

       // Filter categories that have products matching the search query
       $categories->whereHas('products', function ($query) use ($searchQuery) {
           if ($searchQuery) {
               $query->where(DB::raw('LOWER(name)'), 'like', '%' . strtolower($searchQuery) . '%');
           }
       });

       // If category_id is provided, filter further
       if ($categoryIdQuery) {
           $categories->where('id', $categoryIdQuery);
       }

       return Inertia::render('AllProduct', [
           "categories" => CategoryResource::collection($categories->with('products')->get())
       ]);
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
