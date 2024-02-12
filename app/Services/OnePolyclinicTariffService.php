<?php

namespace App\Services;

use App\Models\Polyclinic;
use App\Models\PolyclinicTariff;
use App\Models\Tariff;

class OnePolyclinicTariffService extends AbstractService
{
    /**
     * @param PolyclinicTariff $polyclinicTariff
     */
    public function __construct(PolyclinicTariff $polyclinicTariff)
    {
        $this->model = $polyclinicTariff;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function polyclinicShow($id)
    {
        return Polyclinic::findOrFail($id);
    }

    /**
     * @param array $data
     * @return array|string|void
     */
    public function store(array $data)
    {
        $polyclinic = $this->polyclinicShow($data['polyclinic_id']);
        $tariff = Tariff::findOrFail($data['tariff_id']);

        $messageData = [];

        if ($polyclinic->balance() < $tariff->price) {

            return $messageData = [
                'text' => "Hisobingizda yetarli mablag' mavjud emas!"
            ];
        }

        if ($polyclinic->purchaseTariff($tariff)) {
            return $messageData = [
                'text' => "Obuna muvaffaqiyatli sotib olindi!"
            ];
        }

        return $messageData = [
            'text' => "Obuna sotib olishda muammo yuz berdi!"
        ];


        return $messageData;
    }

}
