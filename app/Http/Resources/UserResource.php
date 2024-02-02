<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'position' => $this->position,
            'profile_photo_url' => $this->profile_photo_url,
            'phone' => $this->phone,
            'role' => $this->role,
            'roleName' => $this->getUserRoleName(),
            'polyclinic_id' => $this->polyclinic_id,
            'polyclinicName' => $this->polyclinic->name,
            'color' => $this->color,
            'percent_treatment' => $this->percent_treatment,
            'sort_order' => $this->sort_order,
            'status' => $this->status,
            'statusName' => $this->getStatusName()
        ];
    }
}
