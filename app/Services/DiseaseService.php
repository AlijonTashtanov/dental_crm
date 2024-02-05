<?php

namespace App\Services;

use App\Models\Disease;

class DiseaseService extends AbstractService
{
    public function __construct(Disease $disease)
    {
        $this->model = $disease;
    }
}
