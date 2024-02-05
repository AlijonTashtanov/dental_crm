<?php

namespace App\Services;

use App\Models\Patient;

class PatientService extends AbstractService
{
    public function __construct(Patient $patient)
    {
        $this->model = $patient;
    }
}
