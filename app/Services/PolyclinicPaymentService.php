<?php

namespace App\Services;

use App\Models\PolyclinicPayment;

class PolyclinicPaymentService extends AbstractService
{
    public function __construct(PolyclinicPayment $polyclinicpayment)
    {
        $this->model = $polyclinicpayment;
    }
}
