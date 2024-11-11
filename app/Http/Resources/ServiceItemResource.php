<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceItemResource extends JsonResource
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
            "service"=> $this->service->name,
            "package_name"=> $this->name,
            "price"=> $this->price,
            'pre_price'=> $this->pre_price,
        ];
    }
}
