<?php

namespace App\Services;


use App\Models\Polyclinic;
use App\Models\PolyclinicPayment;

class OnePolyclinicPaymentService extends AbstractService
{
    /**
     * @param PolyclinicPayment $polyclinicPayment
     */
    public function __construct(PolyclinicPayment $polyclinicPayment)
    {
        $this->model = $polyclinicPayment;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function polyclinicShow($id)
    {
        return Polyclinic::findOrFail($id);
    }
}
