<?php

namespace App\Models;

use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PolyclinicTariff extends Model
{
    use Status;

    /**
     * @var array
     */
    protected $fillable = [];

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

    //<editor-fold desc="Relations">

    /**
     * @return BelongsTo
     */
    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class, 'polyclinic_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'tariff_id', 'id');
    }
    //</editor-fold>
}
