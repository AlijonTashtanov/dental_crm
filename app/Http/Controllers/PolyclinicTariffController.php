<?php

namespace App\Http\Controllers;

use App\Services\PolyclinicTariffService;

class PolyclinicTariffController extends AbstractController
{
    protected $dir = 'polyclinictariffs';
    protected $serviceClass = PolyclinicTariffService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
