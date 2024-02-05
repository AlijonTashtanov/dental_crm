<?php

namespace App\Http\Controllers\Api;

use App\Services\DiseaseService;

class DiseaseController extends AbstractController
{
    protected $service = DiseaseService::class;

    public function index()
    {
        $item = $this->service->index();
        return $this->sendResponse($item);
    }

    public function create()
    {
        $item = $this->service->store(request()->all());
        return $this->sendResponse($item);
    }

    public function update($id)
    {
        $item = $this->service->update($id,request()->all());
        return $this->sendResponse($item);
    }

    public function delete($id)
    {
        $item = $this->service->delete($id);
        return $this->sendResponse($item);
    }
}
