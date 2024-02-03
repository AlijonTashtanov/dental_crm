<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'color' => $this->color,
            'items' => ServiceResource::collection($this->services->where( 'status','!=', Category::$status_deleted)),

        ];
    }
}
