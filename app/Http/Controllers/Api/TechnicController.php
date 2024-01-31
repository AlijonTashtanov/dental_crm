<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\TechnicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TechnicController extends AbstractController
{
    protected $service = TechnicService::class;

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->service->store(request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function update($id)
    {

        $item = $this->service->update(request()->all(), $id);

        return $this->sendResponse($item);
    }
}
