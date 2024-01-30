<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\ReceptionService;
use Illuminate\Http\JsonResponse;

class ReceptionController extends AbstractController
{
    protected $service = ReceptionService::class;

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->service->store(request()->all());

        return $this->sendResponse($item);
    }
}
