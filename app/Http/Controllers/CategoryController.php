<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;

class CategoryController extends AbstractController
{
    protected $dir = 'categories';
    protected $serviceClass = CategoryService::class;

    public function setConfig()
    {
        $this->config = [
            'rules' => [
                //
            ]
        ];
    }
}
