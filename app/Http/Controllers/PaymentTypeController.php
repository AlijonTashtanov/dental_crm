<?php

namespace App\Http\Controllers;

use App\Services\PaymentTypeService;

class PaymentTypeController extends AbstractController
{
    protected $dir = 'paymenttypes';
    protected $serviceClass = PaymentTypeService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
