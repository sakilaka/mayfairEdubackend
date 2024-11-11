<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "user_id"=> $this->user_id,
            "product_id"=> $this->product_id,
            'product_name' => $this->product?->product_name,
            'product_image' => $this->product?->image_show,
            'product_type' => $this->product?->type->name,
            'product_generic' => $this->product?->generic->name,

            'items' => CartItemResource::collection($this->items)
        ];
    }
}
