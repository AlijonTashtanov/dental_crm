<?php

namespace App\Services;

use App\Models\Tariff;
use App\Traits\Status;

class TariffService extends AbstractService
{
    /**
     * @param Tariff $tariff
     */
    public function __construct(Tariff $tariff)
    {
        $this->model = $tariff;
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data)
    {
        $item = new Tariff();

        $translationNames = [
            'uz' => $data['name_uz'],
            'en' => $data['name_en'],
            'ru' => $data['name_ru']
        ];
        $item->price = $data['price'] ?? 0;
        $item->duration_number = $data['duration_number'] ?? 0;
        $item->duration_text = $data['duration_text'] ?? null;
        $item->status = isset($data['status']) ? Status::$status_active : Status::$status_inactive;
//        $item->is_free = isset($data['is_free']) ? 1 : 0;
        $item->max_doctor_count = $data['max_doctor_count'];
        $item->setTranslations('name', $translationNames);
        $item->save();
    }

    public function update(array $data, $id)
    {
        $item = $this->show($id);

        $translationNames = [
            'uz' => $data['name_uz'],
            'en' => $data['name_en'],
            'ru' => $data['name_ru']
        ];
        $item->price = $data['price'] ?? 0;
        $item->duration_number = $data['duration_number'] ?? 0;
        $item->duration_text = $data['duration_text'] ?? null;
        $item->status = isset($data['status']) ? Status::$status_active : Status::$status_inactive;
//        $item->is_free = isset($data['is_free']) ? 1 : 0;
        $item->max_doctor_count = $data['max_doctor_count'];
        $item->setTranslations('name', $translationNames);
        $item->save();
    }
}
