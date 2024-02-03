<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ServiceService extends AbstractService
{
    public function __construct(Service $service)
    {
        $this->model = $service;
    }




}
