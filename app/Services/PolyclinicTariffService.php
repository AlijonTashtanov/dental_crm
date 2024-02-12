<?php

namespace App\Services;

use App\Models\PolyclinicTariff;

class PolyclinicTariffService extends AbstractService
{
    public function __construct(PolyclinicTariff $polyclinictariff)
    {
        $this->model = $polyclinictariff;
    }
}
