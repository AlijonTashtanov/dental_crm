<?php

namespace App\Http\Controllers;

use App\Services\TelegramUserService;

class TelegramUserController extends AbstractController
{
    protected $dir = 'telegramusers';
    protected $serviceClass = TelegramUserService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
