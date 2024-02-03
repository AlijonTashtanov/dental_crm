<?php

namespace App\Services;

use App\Models\Polyclinic;
use App\Models\Region;
use App\Repositories\ClinicRepositories;

class ClinicService extends AbstractService
{
    /**
     * @param Region $region
     */
    public function __construct(Polyclinic $polyclinic, protected ClinicRepositories $clinicRepositories)
    {
        $this->model = $polyclinic;
    }

    public function index()
    {
        return $this->clinicRepositories->getAllModels();
    }
}
