<?php

namespace App\Models;

use App\Traits\PaymentType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class PolyclinicPayment extends Model
{

    use PaymentType;

    /**
     * @var string[]
     */
    protected $fillable = ['id', 'polyclinic_id', 'type_id', 'amount', 'comment', 'transaction_id'];

    /**
     * @param $search
     * @return Builder
     */
    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('amount', 'like', '%' . $search . '%')
                ->orWhere('comment', 'like', '%' . $search . '%');
    }
}
