<?php

namespace App\Http\Livewire\Region;

use App\Http\Livewire\BaseLivewire;
use App\Models\Region;

class RegionTable extends BaseLivewire
{
    public $path = 'region.region-table'; // component view path
    public $model = Region::class; // model
    public $route = 'regions'; // route for actions(CRUD)
}
