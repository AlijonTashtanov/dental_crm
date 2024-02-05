<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\PatientService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class PatientController extends AbstractController
{
    protected $service = PatientService::class;

    public function index()
    {
        $patients = $this->service->index();
        return $this->sendResponse($patients);
    }

    public function create()
    {
        $patient = $this->service->store(request()->all());
        return $this->sendResponse($patient);
    }

    public function update($id)
    {
        $patient = $this->service->store($id,request()->all());
        return $this->sendResponse($patient);
    }



}
