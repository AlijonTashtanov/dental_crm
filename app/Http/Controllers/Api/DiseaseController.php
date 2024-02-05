<?php

namespace App\Http\Controllers\Api;

use App\Services\DiseaseService;
use Illuminate\Http\JsonResponse;

class DiseaseController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = DiseaseService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index();
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function create()
    {
        $item = $this->service->store(request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function update($id)
    {
        $item = $this->service->update($id,request()->all());
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function delete($id)
    {
        $item = $this->service->delete($id);
        return $this->sendResponse($item);
    }
}
