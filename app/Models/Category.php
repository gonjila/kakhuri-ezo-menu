<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Category extends Model implements Sortable
{
    use HasFactory, HasTranslations, SortableTrait;

    protected $guarded = ["id"];
    public array $translatable = ['title'];

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('order', function ($query) {
            $query->orderBy('sort_order');
        });

        static::deleting(function ($product) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        });

        static::updating(function ($product) {
            // Check if the image is being updated
            if ($product->isDirty('image')) {
                $oldImage = $product->getOriginal('image');
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        });
    }
}
