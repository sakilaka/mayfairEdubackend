<?php

namespace App\Http\Resources;

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
        return [
            "id"=> $this->id,
            "name"=> $this->product_name,
            "generic"=> $this->generic->name,
            "type"=> $this->type->name,
            'category'=> $this->category->name,
            'category'=> $this->category->name,
            'discount_percent' =>$this->product_discount,
            'description' => $this->description,
            'return_refund' => $this->return_refund,
            'image' => $this->image_show,
            'price_list'=> UnitPriceResource::collection($this->units),

        ];
    }
}
