<?php

namespace App\Http\Controllers;

use App\Services\DiseaseService;

class DiseaseController extends AbstractController
{
    protected $dir = 'diseases';
    protected $serviceClass = DiseaseService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
