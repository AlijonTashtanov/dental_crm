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
    /**
     * @param $phone
     * @return string
     */
    function clearPhone($phone)
    {
        return strtr($phone, [
            '+' => ''
        ]);
    }
}

// Telefon raqamni formatlab beradi
// +998916700607 => +(998) 91 670 06 07
if (!function_exists('phoneUzbFormat')) {
    function phoneUzbFormat($phone): string
    {
        return "+(" . substr($phone, 0, 3) . ") " . substr($phone, 3, 2) . " " . substr($phone, 5, 3) . " " . substr($phone, 8, 10);
    }
}
// Summani formatlab beradigan funksiya

if (!function_exists('decimal')) {

    function decimal($summa, $decimal = 0, $unit = 'UZS'): string
    {
        return number_format($summa, $decimal, '.', ' ');
    }
}

