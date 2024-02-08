<?php

namespace App\Http\Resources;

use App\Models\Disease;
use App\Models\DiseasePatient;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

class PatientResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'gender_id' => $this->gender_id,
            'gender_name' => $this->getGenderName(),
            'born_date' => Carbon::parse($this->born_date)->format('d.m.Y'),
            'address' => $this->address,
            'phone' => $this->phone ? phoneUzbFormat($this->phone) : '',
            'job' => $this->job,
            'color' => $this->color,
            'balance' => decimal($this->balance),
            'created_at' => Carbon::parse($this->created_at)->format('d.m.Y H:i'),
            'diseases' => DiseaseResource::collection($this->diseases)
        ];
    }
}
