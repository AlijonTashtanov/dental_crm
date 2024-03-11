<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait PaymentType
{
    /**
     * Click orqali to'lov
     * @var int
     */
    public static $payment_type_click = 1;

    /**
     * Payme orqali to'lov
     * @var int
     */
    public static $payment_type_payme = 2;

    /**
     * Naqt pul orqali to'lov
     * @var int
     */
    public static $payment_type_cash = 3;

    /**
     * To'lov kartasi orqali to'lov
     * @var int
     */
    public static $payment_type_card = 4;

    /**
     * @return string[]
     */
    public static function paymentTypes()
    {
        return [
            self::$payment_type_click => 'Click',
            self::$payment_type_payme => 'Payme',
            self::$payment_type_cash => 'Naqt pul orqali',
            self::$payment_type_card => 'Kartadan-kartaga',
        ];
    }

    /**
     * @return array|\ArrayAccess|mixed|string
     */
    public function getpaymentTypeName()
    {
        return Arr::get(self::paymentTypes(), $this->type_id);
    }
}
