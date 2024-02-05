<?php

namespace App\Models;

use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use phpseclib3\File\ASN1\Maps\OtherPrimeInfo;

class Patient extends Model
{

    protected $guarded = ['id'];

    public static $male = 1;
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

    public static function searchPatient($search)
    {
        $patients = self::where('first_name', 'like', "%$search%")
            ->orWhere('last_name', 'like', "%$search%")
            ->orWhere('address', 'like', "%$search%")
            ->orWhere('job', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%")
            ->orWhere('balance', 'like', "%$search%")
            ->where('status', Status::$status_active)
            ->paginate(20);
        return $patients;
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


}
