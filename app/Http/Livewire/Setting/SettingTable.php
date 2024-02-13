<?php

namespace App\Http\Livewire\Setting;

use App\Http\Livewire\BaseLivewire;
use App\Models\Setting;

class SettingTable extends BaseLivewire
{
    public $path = 'setting.setting-table'; // component view path
    public $model = Setting::class; // model
    public $route = 'settings'; // route for actions(CRUD)
}
