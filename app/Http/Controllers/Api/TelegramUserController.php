<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\TelegramUserService;
use Illuminate\Http\JsonResponse;

class TelegramUserController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = TelegramUserService::class;

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

    /**
     * @return array|JsonResponse
     */
    public function search()
    {
        $item = $this->service->search(request()->all());
        return $this->sendResponse($item);
    }

}
