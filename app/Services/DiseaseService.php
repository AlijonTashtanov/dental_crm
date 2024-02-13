<?php

namespace App\Services;

use App\Models\Category;
use App\Services\AbstractService;

class DiseaseService extends AbstractService
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

}
