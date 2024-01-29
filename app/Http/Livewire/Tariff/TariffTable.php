<?php

namespace App\Http\Livewire\Tariff;

use App\Http\Livewire\BaseLivewire;
use App\Models\Tariff;

class TariffTable extends BaseLivewire
{
    public $path = 'tariff.tariff-table'; // component view path
    public $model = Tariff::class; // model
    public $route = 'tariffs'; // route for actions(CRUD)
}
