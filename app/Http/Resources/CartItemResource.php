<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            "unit_id"=> $this->unit_id,
            "unit_name"=> $this->unit->unit,
            "unit_price"=> $this->unit->price,
            "discount"=>round($this->qty * $this->unit->discount , 2),
            "discount_price"=> round($this->unit->price-$this->unit->discount,2),
            'qty' =>$this->qty,
            'sub_total'=>round($this->qty * $this->unit->price , 2),
            'discount_sub_total'=>round($this->qty * round($this->unit->price-$this->unit->discount,2) , 2)
        ];
    }
}
