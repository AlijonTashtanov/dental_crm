<?php

namespace App\Services;

use App\Models\PaymentType;

class PaymentTypeService extends AbstractService
{
    public function __construct(PaymentType $paymenttype)
    {
        $this->model = $paymenttype;
    }
}
