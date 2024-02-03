<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Services\Api\CategoryService;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;

class ServiceCategoryController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = CategoryService::class;




    public function index()
    {
        $item = $this->service->index();

        return $this->sendResponse($item);
    }

    public function createCategory()
    {
        $item = $this->service->createCategory(request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function updateCategory($id)
    {
        $item = $this->service->updateCategory($id, request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function destroyCategory($id)
    {
        $item = $this->service->categoryDestroy($id);

        return $this->sendResponse($item);
    }

    /**
     * @return array|JsonResponse
     */
    public function createService()
    {
        $item = $this->service->createService(request()->all());

        return $this->sendResponse($item);
    }


    /**
     * @return array|JsonResponse
     */
    public function updateService($id)
    {
        $item = $this->service->updateService($id, request()->all());

        return $this->sendResponse($item);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function serviceDestroy($id)
    {
        $item = $this->service->serviceDestroy($id);

        return $this->sendResponse($item);
    }


}
