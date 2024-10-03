<?php

namespace App\Http\Resources;

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
        if($this ->parent_id == 0 && $this->is_sub == 0){
            return [
                "id"=> $this->id,
                "name"=> $this->name,
                 "ok"=> $this->name,
                'color_code' => $this->color_code,
                'icon' => $this->icon_show,
                "is_sub"=> $this->phar_sub->count() > 0 ? 1 :0,
            ];
        }else if($this ->parent_id != 0 && $this->is_sub != 0){
            return [
                "id"=> $this->id,
                "name"=> $this->name,
                'icon' => $this->icon_show,
            ];
        }
        else{
            if($this->phar_sub->count() > 0){
                return [
                    "id"=> $this->id,
                    "name"=> $this->name,
                    "products"=>[],
                    "is_sub"=>1,
                    "child_category_list"=>CategoryResource::collection($this->phar_sub),
                ];
            }else{
                return [
                    "id"=> $this->id,
                    "name"=> $this->name,
                    "products"=>ProductResource::collection($this->sub_products->take(9)),
                    "is_sub"=>0,
                    "child_category_list"=>[]
                ];
            }

        }

    }
}
