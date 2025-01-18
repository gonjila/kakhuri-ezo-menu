<?php

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory, HasTranslations;

    protected $guarded = ["id"];
    public array $translatable = ['name', 'description'];

    function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        // Hook into the saving event
        static::saving(function ($product) {
            if (!$product->discounted_price) {
                if ($product->discount) {
                    $product->discounted_price = $product->price - $product->price * $product->discount / 100;
                } else {
                    $product->discounted_price = null;
                }
            }

            if (!$product->discount) {
                if ($product->discounted_price && $product->price) {
                    $product->discount = round(($product->price - $product->discounted_price ) * 100 / $product->price , 2);
                } else {
                    $product->discount = null;
                }
            }
        });
    }
}
