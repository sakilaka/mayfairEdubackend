<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitPriceResource extends JsonResource
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
            "price"=> $this->price,
            "unit"=> $this->unit,
            "discount_price"=> round($this->price-$this->discount,2),
            "discount"=> $this->discount,
        ];
    }
}
