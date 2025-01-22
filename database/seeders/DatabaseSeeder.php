<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(8)->create();
        Product::factory()->count(20)->create();

        User::factory()->create(["email" => "admin@admin.com", "name" => "Admin", "password" => "password"]);

        $this->call([CategoryProductSeeder::class]);
    }
}
