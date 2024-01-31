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

}
