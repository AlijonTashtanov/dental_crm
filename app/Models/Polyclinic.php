<?php

namespace App\Models;


use App\Traits\PolyclinicBalanceTrait;
use App\Traits\PolyclinicTariffTrait;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Polyclinic extends Model
{
    use Status;
    use PolyclinicBalanceTrait;
    use PolyclinicTariffTrait;

    /**
     * @var array
     */
    protected $fillable = ['name', 'phone', 'address', 'region_id', 'status'];

    /**
     * @param $search
     * @return Builder
     */
    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    /**
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }


}
