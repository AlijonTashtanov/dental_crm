<?php

namespace App\Traits;

use App\Models\PolyclinicPayment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PolyclinicBalanceTrait
{
    /**
     * @return BelongsTo
     */
    public function polyclinicPayments()
    {
        return $this->hasMany(PolyclinicPayment::class, 'polyclinic_id', 'id');
    }

    /**
     * @return int|mixed
     */
    public function getPolyclinicPaymentTotalSum()
    {
        return $this->polyclinicPayments()->sum('amount');
    }

    /**
     * @return int|mixed
     */
    public function balance()
    {
        return $this->getPolyclinicPaymentTotalSum() - $this->getPolyclinicTariffsSum();
    }

    /**
     * @return string
     */
    public function balanceFormatSum()
    {
        return decimal($this->balance());
    }
}
