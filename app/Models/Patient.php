<?php

namespace App\Models;

use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use phpseclib3\File\ASN1\Maps\OtherPrimeInfo;

class Patient extends Model
{

    protected $guarded = ['id'];

    /**
     * Erkak
     * @var int
     */
    public static $male = 1;

    /**
     * Ayol
     * @var int
     */
    public static $woman = 0;


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
     * @return string[]
     */
    public static function genders()
    {
        return [
            self::$male => 'Erkak',
            self::$woman => 'Ayol',
        ];
    }

    /**
     * @return array|\ArrayAccess|mixed|string
     */
    public function getGenderName()
    {
        return Arr::get(self::genders(), $this->gender_id);
    }

    /**
     * @return BelongsToMany
     */
    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }


}
