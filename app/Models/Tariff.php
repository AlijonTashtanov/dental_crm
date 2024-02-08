<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Tariff extends Model
{
    use Status;
    use HasTranslations;

    protected $fillable = [];

    /**
     * @var string[]
     */
    public $translatable = ['name'];

    /**
     * @param $search
     * @return Builder
     */
    public static function search($search)
    {
        return empty($search)
            ? static::query()
            : static::query()->where('name->uz', 'like', '%' . $search . '%');
    }


    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::saving(function (Tariff $model) {
            $model->fee_for_one_doctor = intval($model->max_doctor_count > 0 ? $model->price / $model->max_doctor_count : 0);
        });

    }

    //<editor-fold desc="Duration">

    /**
     * @return string[]
     */
    public static function durationTexts()
    {
        return [
            'day' => 'kun',
            'month' => 'oy',
            'year' => 'yil',
        ];
    }

    /**
     * @return string
     */
    public function getDurationTextName()
    {
        return Arr::get(self::durationTexts(), $this->duration_text);
    }

    /**
     * @return string
     */
    public function getDuration()
    {

        return $this->duration_number . ' ' . $this->duration_text;
    }

    /**
     * @return string
     */
    public function getDurationName()
    {
        return $this->duration_number . ' ' . $this->getDurationTextName();
    }

    //</editor-fold>

    /**
     * @return bool
     */
    public function getIsFree()
    {
        return $this->is_free == 1;
    }

    /**
     * @return string
     */
    public function getIsFreeText()
    {
        return $this->is_free == 1 ? 'Ha' : "Yo'q";
    }

    /**
     * @return string
     */
    public function getIsFreeBadgeText()
    {
        if ($this->is_free == 1) {
            return "<span class='badge badge-success'>Ha</span>";
        }
        return "<span class='badge badge-danger'>Yo'q</span>";
    }
}
