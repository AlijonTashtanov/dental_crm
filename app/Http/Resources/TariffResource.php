<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TariffResource extends JsonResource
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
            'name' => $this->getTranslation('name', app()->getLocale()),
            'price' => $this->price,
            'priceFormat' => decimal($this->price),
            'durationName' => $this->getDurationName(),
//            'duration_number' => $this->duration_number,
//            'duration_text' => $this->duration_text,
            'max_doctor_count' => $this->max_doctor_count,
        ];
    }
}
