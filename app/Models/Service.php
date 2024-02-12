<?php

namespace App\Models;

use App\Traits\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [];
    use Status;


    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    /**
     * @return BelongsTo
     */
    public function polyclinic()
    {
        return $this->belongsTo(Polyclinic::class);
    }
}
