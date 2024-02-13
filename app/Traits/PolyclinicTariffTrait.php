<?php

namespace App\Traits;

use App\Models\PolyclinicTariff;
use App\Models\Tariff;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait PolyclinicTariffTrait
{
    /**
     * @var int Polyklinika sotib olgan barcha tariflarining um. summasi
     * @see getPolyclinicTariffsSum
     */
    private $_polyclinicTariffsSum;

    /**
     * @var
     */
    private $_hasActiveTariff;

    /**
     * @return BelongsTo
     */
    public function polyclinicTariffs()
    {
        return $this->hasMany(PolyclinicTariff::class, 'polyclinic_id', 'id');
    }


    /**
     * @return mixed
     */
    public function activePolyclinicTariff()
    {
        return $this->belongsTo(PolyclinicTariff::class, 'id', 'polyclinic_id')
            ->where('status', Status::$status_active)
            ->where('expire_at', '>=', date('Y-m-d H:i:s'));
    }

    /**
     * @return mixed
     */
    public function lastPolyclinicTariff()
    {
        return $this->belongsTo(PolyclinicTariff::class, 'id', 'polyclinic_id')
            ->where('status', Status::$status_active)
            ->orderBy('expire_at', 'desc');
    }


    /**
     * @return mixed
     */
    public function activeTariff()
    {
        return $this->belongsTo(Tariff::class, 'id', 'tariff_id')->withPivot('activePolyclinicTariff');
    }

    /**
     * Foydalanuvchi ayni vaqtda faol tarifga egami?
     * Agar true bo'lsa, foydalanuvchi premium videolarni ko'rishi mn bo'ladi.
     * @return bool
     */
    public function hasActiveTariff()
    {
        if ($this->_hasActiveTariff === null) {
            $this->_hasActiveTariff = $this->activePolyclinicTariff()->exists();
        }
        return $this->_hasActiveTariff;
    }

    /**
     * Purchase new tariff
     * @param  $tariff
     * @return bool
     */
    public function purchaseTariff(Tariff $tariff)
    {

        $lastTariff = $this->lastPolyclinicTariff;

        $activeTariff = $this->activePolyclinicTariff;

        if ($activeTariff && $activeTariff->tariff_id != $tariff->id) {
            $polyclinicTariffs = PolyclinicTariff::where('expire_at', '>=', date('Y-m-d H:i:s'))
                ->where('polyclinic_id', $this->id)
                ->get();

            foreach ($polyclinicTariffs as $polyclinicTariff) {
                $polyclinicTariff->status = PolyclinicTariff::$status_cancel; // Hisoblanmaydi
                $polyclinicTariff->save();
            }
        }

        if ($lastTariff && $tariff->id == $activeTariff->tariff_id) {
            $begin = $lastTariff->expire_at;
            if ($begin < date('Y-m-d H:i:s')) {
                $begin = date('Y-m-d H:i:s');
            }
        } else {
            $begin = date('Y-m-d H:i:s');
        }

        $polyclinicTariff = new PolyclinicTariff();
        $polyclinicTariff->tariff_id = $tariff->id;
        $polyclinicTariff->max_doctor_count = $tariff->max_doctor_count;
        $polyclinicTariff->fee_for_one_doctor = $tariff->fee_for_one_doctor;
        $polyclinicTariff->polyclinic_id = $this->id;
        $polyclinicTariff->price = $tariff->price;
        $polyclinicTariff->status = PolyclinicTariff::$status_active;
        $polyclinicTariff->start_at = $begin;
        $polyclinicTariff->expire_at = date('Y-m-d H:i:s', strtotime("+" . $tariff->getDuration(), strtotime($begin)));

        return $polyclinicTariff->save();
    }

    /**
     * Poliklinika sotib olgan barcha tariflarining um. summasi
     * @return int
     */
    public function getPolyclinicTariffsSum()
    {
        if ($this->_polyclinicTariffsSum === null) {
            $this->_polyclinicTariffsSum = (int)$this->polyclinicTariffs()
                ->sum('price');
        }

        return $this->_polyclinicTariffsSum;
    }
}
