<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\PolyclinicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PolyclinicController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = PolyclinicService::class;

    /**
     * @return array|JsonResponse
     */
    public function register()
    {
        $item = $this->service->register(request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function verify()
    {

        $item = $this->service->verify(request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function login()
    {
        $item = $this->service->login(request()->all());

        return $this->sendResponse($item);
    }
}
