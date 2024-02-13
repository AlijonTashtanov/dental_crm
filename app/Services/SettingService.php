<?php

namespace App\Services;

use App\Models\Setting;

class SettingService extends AbstractService
{
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }
}
