<?php

namespace App\Services;

use App\Models\Service;

class ServiceService extends AbstractService
{
    public function __construct(Service $service)
    {
        $this->model = $service;
    }
}
