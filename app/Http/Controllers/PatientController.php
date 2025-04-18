<?php

namespace App\Http\Controllers;

use App\Services\Api\PatientService;

class PatientController extends AbstractController
{
    protected $dir = 'patients';
    protected $serviceClass = PatientService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
