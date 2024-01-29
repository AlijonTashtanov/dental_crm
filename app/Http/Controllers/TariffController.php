<?php

namespace App\Http\Controllers;

use App\Services\TariffService;

class TariffController extends AbstractController
{
    protected $dir = 'tariffs';
    protected $serviceClass = TariffService::class;

    protected $permissionCheck = false;

    /**
     * @return void
     */
    public function setConfig()
    {
        $this->config = [
            'rules' => [
                'name_uz' => 'required|string|max:2056',
                'name_ru' => 'required|string|max:2056',
                'name_en' => 'required|string|max:2056',
                'price' => 'required|integer|min:0',
                'duration_number' => 'required|integer|min:0',
                'duration_text' => 'required|string|max:255',
                'is_free' => '',
                'status' => ''
            ]
        ];
    }

}
