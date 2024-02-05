<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender_id' => $this->gender_id,
            'gender_name' => $this->getGender(),
            'born_date' => $this->born_date,
            'address' => $this->address,
            'phone' => $this::phoneNumber($this->phone),
            'job' => $this->job,
            'color' => $this->color,
        ];
    }
}
