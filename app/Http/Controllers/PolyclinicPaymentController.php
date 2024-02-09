<?php

namespace App\Http\Controllers;

use App\Services\PolyclinicPaymentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PolyclinicPaymentController extends AbstractController
{
    /**
     * @var string
     */
    protected $dir = 'polyclinicpayments';

    /**
     * @var string
     */
    protected $serviceClass = PolyclinicPaymentService::class;

    /**
     * @var bool
     */
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
