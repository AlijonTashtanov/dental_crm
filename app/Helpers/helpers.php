<?php

use App\Models\Translation;

if (!function_exists('lang')) {

    function lang($key, $lang = null): string
    {
        $model = Translation::where('key', $key)
            ->first();

        if (!$model) {
            return $key;
        }

        if (!$lang) {
            return $model->getTranslation('value', app()->getLocale());
        }
        return $model->getTranslation('value', $lang);
    }
}

// Telefon raqamni tozalab beradi
// +998916700607 => 998916700607
if (!function_exists('clearPhone')) {
    function clearPhone($phone)
    {
        return strtr($phone, [
            '+' => ''
        ]);
    }
}
