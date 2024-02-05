<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'polyclinic_id' => $this->polyclinic_id,
            'polyclinic' => $this->polyclinic->name,
            'material_price' => $this->material_price,
            'materialPriceFormat' => decimal($this->material_price),
            'technic_price' => $this->technic_price,
            'technicPriceFormat' => decimal($this->technic_price),
            'price' => $this->price,
            'priceFormat' => decimal($this->price),
            'status' => $this->status,
            'statusName' => $this->getStatusName(),
        ];
    }
}
