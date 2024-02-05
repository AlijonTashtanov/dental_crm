<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    protected $guarded = ['id'];

    public static $male = 1;
    public static $woman = 0;

    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name', 'like', '%' . $search . '%');
    }

    public  function getGender()
    {
        $gender = null;
        $gender = $this->gender_id == $this->male ? 'erkak' : 'ayol';
        return $gender;
    }

}
