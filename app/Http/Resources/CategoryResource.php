<?php

namespace App\Http\Resources;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Category $this */
        return [
//            ...parent::toArray($request),
            "id" =>  $this->id,
            "title" => $this->title,
            "image" => $this->image,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
