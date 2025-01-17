<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $products = Product::all();

        foreach ($products as $product) {
            $randomCategory = $categories->random(rand(1, 3))->pluck('id')->toArray();
            $product->categories()->attach($randomCategory);
        }
    }
}
