<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'polyclinic_id' => $this->polyclinic_id,
            'polyclinic' => $this->polyclinic->name,
            'material_price' => $this->material_price,
            'technic_price' => $this->technic_price,
            'price' => $this->price,
            'status' => $this->getStatusName(),
        ];
    }
}
