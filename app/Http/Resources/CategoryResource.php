<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $searchQuery = request()->query('search');

        /** @var Category $this */
        return [
            "id" =>  $this->id,
            "title" => $this->title,
            "image" => $this->image,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "products" => $this->whenLoaded('products', function () use ($searchQuery) {
                return ProductResource::collection(
                    $this->products->filter(function ($product) use ($searchQuery) {
                        return !$searchQuery || stripos($product->name, $searchQuery) !== false;
                    })
                );
            }),
        ];
    }
}
