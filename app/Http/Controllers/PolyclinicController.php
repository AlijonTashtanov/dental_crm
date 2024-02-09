<?php

namespace App\Http\Controllers;

use App\Services\PolyclinicService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PolyclinicController extends AbstractController
{
    protected $dir = 'polyclinics';
    protected $serviceClass = PolyclinicService::class;

    protected $permissionCheck = false;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }

    /**
     * @return Application|Factory|View
     */
    public function polyclinicPayments($id)
    {
        $response = $this->service->show($id);
        return view('admin.' . $this->dir . '.polyclinic-payments', compact('response')); //index
    }
}
