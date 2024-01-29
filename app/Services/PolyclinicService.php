<?php

namespace App\Services;

use App\Models\Polyclinic;

class PolyclinicService extends AbstractService
{
    public function __construct(Polyclinic $polyclinic)
    {
        $this->model = $polyclinic;
    }


}
