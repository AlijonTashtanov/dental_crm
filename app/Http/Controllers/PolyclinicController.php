<?php

namespace App\Http\Controllers;

use App\Services\PolyclinicService;

class PolyclinicController extends AbstractController
{
    protected $dir = 'polyclinics';
    protected $serviceClass = PolyclinicService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
