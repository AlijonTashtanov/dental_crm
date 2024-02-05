<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends AbstractController
{
    protected $service = PatientService::class;

    public function index()
    {
        return 'sas';
        $patients = $this->service->index();
        return $this->sendResponse($patients);
    }

}
