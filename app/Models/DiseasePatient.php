<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseasePatient extends Model
{
    protected $table = 'disease_patient';
    protected $fillable = [];

    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }
}
