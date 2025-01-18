<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Product $this */
        return [
            ...parent::toArray($request),
            "name" => $this->name,
            "description" => $this->description,
            "price" => round($this->price, 2),
            "discount" => round($this->discount, 2),
            "discounted_price"=>round($this->discounted_price, 2),
            "is_popular" => boolVal($this->is_popular),
            "is_in_stock" => boolVal($this->is_in_stock),
        ];
    }
}
