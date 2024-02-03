<?php

namespace App\Repositories;

use App\Interfaces\ClinicRepositoryInterface;
use App\Models\Polyclinic;

class ClinicRepositories implements ClinicRepositoryInterface
{

    public function getAllModels()
    {
        return Polyclinic::paginate(10);
    }

    public function getModelById($id)
    {
        // TODO: Implement getModelById() method.
    }

    public function createModel($data)
    {
        // TODO: Implement createModel() method.
    }

    public function updateModel($data, $id)
    {
        // TODO: Implement updateModel() method.
    }

    public function deleteModel($id)
    {
        // TODO: Implement deleteModel() method.
    }
}
