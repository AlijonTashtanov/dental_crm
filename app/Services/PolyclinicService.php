<?php

namespace App\Services;

use App\Models\Polyclinic;

class PolyclinicService extends AbstractService
{
    /**
     * @param Polyclinic $polyclinic
     */
    public function __construct(Polyclinic $polyclinic)
    {
        $this->model = $polyclinic;
    }
    public function store(array $data)
    {
        Polyclinic::create($data); // Agar fillable to‘g‘ri bo‘lsa, bu eng qulay yo‘l
    }

}
