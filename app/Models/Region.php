<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Region extends Model
{
    use HasRoles;
    use HasTranslations;
    use Status;

    /**
     * @var string[]
     */
    public $translatable = ['name'];

    protected $fillable = [];

    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name->uz', 'like', '%' . $search . '%');
    }
}
