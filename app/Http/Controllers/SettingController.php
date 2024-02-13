<?php

namespace App\Http\Controllers;

use App\Services\SettingService;

class SettingController extends AbstractController
{
    protected $dir = 'settings';
    protected $serviceClass = SettingService::class;
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
