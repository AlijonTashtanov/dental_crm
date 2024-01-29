<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\DoctorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends AbstractController
{

    /**
     * @var string
     */
    protected $service = DoctorService::class;

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $item = $this->service->index(request()->all());

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
     * @return array|JsonResponse
     */
    public function update($id)
    {

        $item = $this->service->update(request()->all(), $id);

        return $this->sendResponse($item);
    }
}
