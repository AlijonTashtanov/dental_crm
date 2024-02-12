<?php

namespace App\Traits;

trait QueriesTrait
{

    // Define an "active" scope
    /**
     * Aktiv ma'lumotlarni olish uchun ishlatiladi
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', Status::$status_active);
        // Adjust the column name and condition as per your database structure
    }

    /**
     * Faol va Nofaol ma'lumotlarni olish uchun ishlatiladi
     * @param $query
     * @return mixed
     */
    public function scopeNotDeleted($query)
    {
        return $query->where('status', '!=', Status::$status_deleted);
    }
}
