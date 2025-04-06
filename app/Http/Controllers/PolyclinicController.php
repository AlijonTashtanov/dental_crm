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
                'name' => 'required|min:3',
                'phone' => 'required',
                'address' => 'required|string',
                'region_id' => 'required|exists:regions,id',// agar status "active"/"inactive" bo‘lsa
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

    /**
     * @return Application|Factory|View
     */
    public function polyclinicTariffs($id)
    {
        $response = $this->service->show($id);
        return view('admin.' . $this->dir . '.polyclinic-tariffs', compact('response')); //index
    }
}
