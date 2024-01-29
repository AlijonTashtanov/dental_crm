<?php

namespace App\Services;

use App\Models\Tariff;

class TariffService extends AbstractService
{
    public function __construct(Tariff $tariff)
    {
        $this->model = $tariff;
    }
}
