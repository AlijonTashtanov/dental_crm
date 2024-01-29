<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AbstractController extends Controller
{
    /**
     * @var mixed
     */
    protected $service;

    /**
     *
     */
    public function __construct()
    {
        $this->service = new $this->service;
    }

    /**
     * @return array|JsonResponse
     */
    public function index()
    {
        $items = $this->service->index();
        return $this->sendResponse($items);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function show($id)
    {
        $item = $this->service->show($id);
        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function store()
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
        $item = $this->service->update(request()->all(), $id);
        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function destroy($id)
    {
        $item = $this->service->destroy($id);

        return $this->sendResponse($item);
    }

    /**
     * @param $data
     * @return array|JsonResponse
     */
    public function sendResponse($data)
    {

        return response()->json($data, $data['statusCode'] ?? 200);
    }
}
