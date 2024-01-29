<?php

namespace App\Http\Controllers;

use App\Services\TariffService;

class TariffController extends AbstractController
{
    protected $dir = 'tariffs';
    protected $serviceClass = TariffService::class;

    protected $permissionCheck = false;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
