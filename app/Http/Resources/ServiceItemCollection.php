<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        if($this->collection->count() > 0) {
            return [
                'data' => $this->collection,
                "success" => "ok",
            ];
        }else{
           return [
                'data' => $this->collection,
                "success" => "no",
            ];
        }
    }
}
