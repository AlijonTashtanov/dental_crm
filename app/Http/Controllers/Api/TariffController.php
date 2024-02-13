<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\TariffService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TariffController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = TariffService::class;


    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index();

        return $this->sendResponse($item);
    }
}
