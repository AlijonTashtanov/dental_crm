<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\CategoryService;
use Illuminate\Http\JsonResponse;

class ServiceCategoryController extends AbstractController
{
    /**
     * @var string
     */
    protected $service = CategoryService::class;


    /**
     * @return array|JsonResponse
     */
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

}
