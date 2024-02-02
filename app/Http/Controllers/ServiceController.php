<?php

namespace App\Http\Controllers;

use App\Services\ServiceService;

class ServiceController extends AbstractController
{
    protected $dir = 'services';
    protected $serviceClass = ServiceService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
