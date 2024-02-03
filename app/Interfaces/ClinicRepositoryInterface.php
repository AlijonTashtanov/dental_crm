<?php

namespace App\Interfaces;

interface ClinicRepositoryInterface
{
    public function getAllModels();
    public function getModelById($id);
    public function createModel($data);
    public function updateModel($data, $id);
    public function deleteModel($id);
}
